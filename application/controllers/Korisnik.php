<?php

class Korisnik extends CI_Controller {

    public $kontroler = 'Korisnik';

    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->model("ModelGost");
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_korisnik.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function dodajKompaniju($data = []) {
        $data['tip'] = 'dodaj';
        $data['kontroler'] = $this->kontroler;
        $this->loadView("dodajKompaniju.php", $data);
    }

    public function dodavanjeOglasa() {
        //$kontroler=$this->kontroler;
        $this->form_validation->set_rules("oglasnaslov", "Naslov oglasa", "required");    // smeju da budu samo slova, brojevi, "_", "-" i razmaci 
        $this->form_validation->set_rules("oglastext", "Tekst oglasa", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajOglas();
        } else {
            $praksa = $this->input->post('praksa');
            $zaposlenje = $this->input->post('zaposlenje');
            if ($praksa == NULL) {
                $praksa = 0;
            }
            if ($zaposlenje == NULL) {
                $zaposlenje = 0;
            }
            $oglas = array('oglasnaslov' => $this->input->post('oglasnaslov'),
                'oglastext' => $this->input->post('oglastext'),
                'praksa' => $praksa,
                'zaposlenje' => $zaposlenje,
                'datum_unosenja' => $this->input->post('datum_unosenja'),
                'id_partnera' => $this->input->post('id_partnera')
            );
            $config['upload_path'] = './assets/fajlovi/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png|tiff';
            $config['max_size'] = '0';  // ovo znaci da je max file size neogranicen, ali nece da radi, jer php ima svoje ogranicenje od 2MB koje mora da se promeni negde u php.ini fajlu
            $sredjenNaslovOglasa = preg_replace('/\s+/', '_', $oglas['oglasnaslov']);
            $config['file_name'] = $oglas['id_partnera'] . "_" . $sredjenNaslovOglasa . "_" . md5($oglas['datum_unosenja']);

            $this->load->library('upload', $config);
            $this->upload->do_upload('fajl');

            $imeFajla = $this->upload->data('file_name');     // ova metoda "data" nam daje podatke o fajlu nakon sto je upload-ovan
            $insertovanidOglasa = $this->ModelKorisnik->dodatOglas($oglas);
            $oglasnaslov = $oglas['oglasnaslov'];
            $oglasPutanja = 'assets/fajlovi/' . $imeFajla;
            $this->ModelKorisnik->dodajOglasFajl($oglasnaslov, $oglasPutanja, $insertovanidOglasa);

            $this->posaljiMejlObavestenje($oglas);
        }
    }

    public function posaljiMejlObavestenje($oglas) {
        $primaociMejla = $this->ModelKorisnik->dohvatiPartnere($oglas['id_partnera']);
        $adresePrimalaca = [];
        foreach ($primaociMejla as $primalacMejla) {
            array_push($adresePrimalaca, $primalacMejla['email']);
        }
        // $data['adresePrimalaca'] = $adresePrimalaca;

        $this->load->library('email');
        $to = implode(",", $adresePrimalaca);
        $subject = "Dodat je oglas sa naslovom: " . $oglas['oglasnaslov'];
        $message = "Sadrzina oglasa: " . $oglas['oglastext'];
        $result = $this->email
                ->from('no-reply@etf.rs')
                ->to($to)
                ->subject($subject)
                ->message($message)
                ->send();
        if ($result) {
            $data['poruka'] = "Mejl je uspesno poslat.";
        } else {
            $data['poruka'] = "Mejl nije poslat.";
        }

        $this->loadView("slanjeObavestenja.php", $data);
    }

    public function index() {
        $data['kontroler'] = $this->kontroler;
        $data['metoda'] = 'index';
        $limit = 2;
        $pocetni_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($this->input->get('pronadji') == 'Pronadji') {
            $this->session->unset_userdata('kompanija');
            $this->session->unset_userdata('paket');
            $this->session->unset_userdata('vazeciUgovor');
        }
        $kompanija = '';
        if ($this->input->get('kompanija')) {
            $this->session->unset_userdata('paket');
            $kompanija = $this->input->get('kompanija');
            $this->session->set_userdata('kompanija', $kompanija);
        } elseif ($this->session->userdata('kompanija')) {
            $kompanija = $this->session->userdata('kompanija');
        }
        $paket = '';
        if ($this->input->get('paket')) {
            $this->session->unset_userdata('kompanija');
            $paket = $this->input->get('paket');
            $this->session->set_userdata('paket', $paket);
        } elseif ($this->session->userdata('paket')) {
            $paket = $this->session->userdata('paket');
        }
        $vazeciUgovor = '';
        if ($this->input->get('vazeciUgovor')) {
//            $this->session->unset_userdata('kompanija');
//            $this->session->unset_userdata('paket');
            $vazeciUgovor = $this->input->get('vazeciUgovor');
            $this->session->set_userdata('vazeciUgovor', $vazeciUgovor);
        } elseif ($this->session->userdata('vazeciUgovor')) {
            $vazeciUgovor = $this->session->userdata('paket');
        }

        $rezultat = $this->ModelKorisnik->pretragaPartnera($limit, $pocetni_index, $vazeciUgovor, $kompanija, $paket);
        $data['rezultat'] = $rezultat;
        $ukupanBrPartnera = $this->ModelKorisnik->brojPartnera($kompanija, $paket, $vazeciUgovor);

        $data['ukupanBroj'] = $ukupanBrPartnera;

        $this->config->load('bootstrap_pagination');
        $config_pagination = $this->config->item('pagination');
        $config_pagination['base_url'] = site_url("Korisnik/index");
        $config_pagination['total_rows'] = $ukupanBrPartnera;
        $config_pagination['per_page'] = $limit;
        $config_pagination['next_link'] = 'Next';
        $config_pagination['prev_link'] = 'Prev';

        $this->pagination->initialize($config_pagination);
        $data['links'] = $this->pagination->create_links();

        $this->loadView("partneriClanovi.php", $data);
    }

    public function dodajOglas() {
        $partneriOglasi = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriOglasi'] = $partneriOglasi;
        $data['kontroler'] = $this->kontroler;
        $this->loadView("dodajOglas.php", $data);
    }

    public function dodajPredavanje() {
        $data['kontroler'] = $this->kontroler;
        $partneriPredavanja = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriPredavanja'] = $partneriPredavanja;
        $this->loadView("dodajPredavanje.php", $data);
    }

    public function logout() {
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect("Gost");
    }

    public function paketi() {
        $paketi = $this->ModelGost->spisakPaketa();
        $paketiStavke = $this->ModelGost->ispisPaketa();
        $data['paketi'] = $paketi;
        $data['paketiStavke'] = $paketiStavke;
        $this->loadView("paketi.php", $data);
    }

    public function oglasi() {
        $data['kontroler'] = $this->kontroler;
        $data['oglasi'] = $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler'] = $this->kontroler;
        $data['predavanja'] = $predavanja;
        $this->loadView("predavanja.php", $data);
    }

    public function arhiva() {
        $predavanja = $this->ModelGost->ispisPredavanjaArhiva();
        $data['predavanja'] = $predavanja;
        $this->loadView("arhivaPredavanja.php", $data);
    }

    public function partneri() {
        $kompanija = $this->input->post("kompanija");
        $partneri = $this->ModelGost->pretraga($kompanija);
        $paketi = $this->ModelGost->spisakPaketa();
        $data['paketi'] = $paketi;
        foreach ($paketi as $paket) {
            $naziv_paketa = $paket['naziv_paketa'];
            $data['partneri'][$naziv_paketa] = $this->filtrirajPartnere($paket, $partneri);
        }
        $data['kontroler'] = $this->kontroler;
        $this->loadView("partneri.php", $data);
    }

    private function filtrirajPartnere($paket, $partneri) {
        $filter = array($paket['naziv_paketa']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['naziv_paketa'], $filter);
        });
        return $filtriraniPartneri;
    }

    public function dodajPartnera() {
        $this->form_validation->set_rules("naziv", "naziv", "required");
        $this->form_validation->set_rules("adresa", "adresa", "required");
        $this->form_validation->set_rules("postanski_broj", "postanski broj", "required");
        $this->form_validation->set_rules("grad", "grad", "required");
        $this->form_validation->set_rules("drzava", "drzava", "required");
        $this->form_validation->set_rules("ziro_racun", "ziro racun", "required");
        $this->form_validation->set_rules("valuta_racuna", "valuta racuna", "required");
        $this->form_validation->set_rules("PIB", "PIB", "required");
        $this->form_validation->set_rules("telefon1", "telefon1", "required|min_length[9]");
        $this->form_validation->set_rules("email1", "email1", "required|valid_email");
        $this->form_validation->set_rules("opis", "opis", "required");
        $this->form_validation->set_rules("veb_adresa", "veb adresa", "required");
        $this->form_validation->set_rules("ime_kontakt_osobe", "ime kontakt osobe", "required");
        $this->form_validation->set_rules("prezime_kontakt_osobe", "prezime kontakt osobe", "required");
        $this->form_validation->set_rules("telefon_kontakt_osobe", "telefon kontakt osobe", "required");
        $this->form_validation->set_rules("email_kontakt_osobe", "email kontakt osobe", "required|valid_email");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        $this->form_validation->set_message("min_length", "Polje {field} mora imati najmanje 9 karaktera");
        $this->form_validation->set_message("valid_email", "Polje {field} mora sadržati validnu email adresu");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajKompaniju();
        } else {
            $partner = array(
                'naziv' => $this->input->post('naziv'),
                'adresa' => $this->input->post('adresa'),
                'postanski_broj' => $this->input->post('postanski_broj'),
                'grad' => $this->input->post('grad'),
                'drzava' => $this->input->post('drzava'),
                'ziro_racun' => $this->input->post('ziro_racun'),
                'valuta_racuna' => $this->input->post('valuta_racuna'),
                'PIB' => $this->input->post('PIB'),
                'telefon1' => $this->input->post('telefon1'),
                'telefon2' => $this->input->post('telefon2'),
                'email1' => $this->input->post('email1'),
                'email2' => $this->input->post('email2'),
                'email3' => $this->input->post('email3'),
                'email4' => $this->input->post('email4'),
                'email5' => $this->input->post('email5'),
                'opis' => $this->input->post('opis'),
                'veb_adresa' => $this->input->post('veb_adresa'),
                'ime_kontakt_osobe' => $this->input->post('ime_kontakt_osobe'),
                'prezime_kontakt_osobe' => $this->input->post('prezime_kontakt_osobe'),
                'telefon_kontakt_osobe' => $this->input->post('telefon_kontakt_osobe'),
                'email_kontakt_osobe' => $this->input->post('email_kontakt_osobe'),
            );

            $insertovanidPartnera = $this->ModelKorisnik->dodatPartner($partner);
            for ($i = 1; $i <= 5; $i++) {
                if (!empty($partner['email' . $i])) {
                    $email = $partner['email' . $i];
                    $this->ModelKorisnik->dodatEmailPartnera($email, $insertovanidPartnera);
                }
            }
            for ($i = 1; $i <= 2; $i++) {
                if (!empty($partner['telefon' . $i])) {
                    $telefon = $partner['telefon' . $i];
                    $this->ModelKorisnik->dodatTelefonPartnera($telefon, $insertovanidPartnera);
                }
            }

            $config['upload_path'] = './assets/logo/';

            $config['allowed_types'] = 'png|jpg|jpeg|gif|tiff';
            $config['max_size'] = 1000;
            $config['max_width'] = 1524;
            $config['max_height'] = 1068;
            $config['file_name'] = $partner['naziv'];


            $this->load->library('upload');
            $this->upload->initialize($config);

            $this->load->library('upload', $config);
            $this->upload->do_upload('logo');

            $logo = $partner['naziv'];
            $putanja = 'assets/logo/' . $logo;
            $this->ModelKorisnik->dodatLogo($logo, $putanja, $insertovanidPartnera);
            $data['tip'] = 'dodaj';

            // redirect("Korisnik/dodajKompaniju/" . $data);
            $this->dodajKompaniju($data);
        }
    }

    public function dodavanjePredavanja() {
        $this->form_validation->set_rules("naslov_srpski", "naslov srpski", "required");
        $this->form_validation->set_rules("opis_srpski", "opis srpski", "required");
        $this->form_validation->set_rules("vreme_predavanja", "vreme predavanja", "required");
        $this->form_validation->set_rules("sala", "sala", "required");
        $this->form_validation->set_rules("ime_predavaca", "ime predavaca", "required");
        $this->form_validation->set_rules("prezime_predavaca", "prezime predavaca", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajPredavanje();
        } else {
            $predavanje = array(
                'naslov_srpski' => $this->input->post('naslov_srpski'),
                'naslov_engleski' => $this->input->post('naslov_engleski'),
                'opis_srpski' => $this->input->post('opis_srpski'),
                'opis_engleski' => $this->input->post('opis_engleski'),
                'vreme_predavanja' => $this->input->post('vreme_predavanja'),
                'sala' => $this->input->post('sala'),
                'ime_predavaca' => $this->input->post('ime_predavaca'),
                'prezime_predavaca' => $this->input->post('prezime_predavaca'),
                'cv_srpski' => $this->input->post('cv_srpski'),
                'cv_engleski' => $this->input->post('cv_engleski'),
                'partner_idPartner' => $this->input->post('id_partnera')
            );

            $config['upload_path'] = './assets/fajlovi/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png|tiff';
            $config['file_name'] = $predavanje['naslov_srpski'] . "_" . $predavanje['ime_predavaca'] . $predavanje['prezime_predavaca'];

            $this->load->library('upload', $config);
            $this->upload->do_upload('fajl');

            $this->ModelKorisnik->dodatoPredavanje($predavanje);
            redirect("$this->kontroler/predavanja");
        }
    }

    public function dosije($kompanija, $value = NULL) {
        $partner = $this->ModelKorisnik->dosijePartner($kompanija);
        $ugovori = $this->ModelKorisnik->pretragaUgovora($kompanija);
        $telefoni = $this->ModelKorisnik->pretragaTelefoni($kompanija);
        $mejlovi = $this->ModelKorisnik->pretragaMejlovi($kompanija);
        $logoi = $this->ModelKorisnik->pretragaLogo($kompanija);
        $data['logoi'] = $logoi;
        $data['telefoni'] = $telefoni;
        $data['mejlovi'] = $mejlovi;
        $data['partner'] = $partner;
        $data['ugovori'] = $ugovori;
        $data['kontroler'] = $this->kontroler;
        if ($value == NULL) {
            $this->loadView("dosije.php", $data);
        } else {
            $data['tip'] = 'promeni';
            $this->loadView("dodajKompaniju.php", $data);
        }
    }

    public function promeniPartnera() {
        $partner = array(
            'idPartner' => $this->input->post('idPartner'),
            'naziv' => $this->input->post('naziv'),
            'adresa' => $this->input->post('adresa'),
            'postanski_broj' => $this->input->post('postanski_broj'),
            'grad' => $this->input->post('grad'),
            'drzava' => $this->input->post('drzava'),
            'ziro_racun' => $this->input->post('ziro_racun'),
            'valuta_racuna' => $this->input->post('valuta_racuna'),
            'PIB' => $this->input->post('PIB'),
            'opis' => $this->input->post('opis'),
            'veb_adresa' => $this->input->post('veb_adresa'),
            'ime_kontakt_osobe' => $this->input->post('ime_kontakt_osobe'),
            'prezime_kontakt_osobe' => $this->input->post('prezime_kontakt_osobe'),
            'telefon_kontakt_osobe' => $this->input->post('telefon_kontakt_osobe'),
            'email_kontakt_osobe' => $this->input->post('email_kontakt_osobe')
        );
        $this->ModelKorisnik->promeniPartnera($partner);

        $telefoni = array(array(
                'telefon' => $this->input->post('telefon1'),
                'idTelefon' => $this->input->post('telefonId1')),
            array(
                'telefon' => $this->input->post('telefon2'),
                'idTelefon' => $this->input->post('telefonId2'))
        );
        for ($i = 0; $i < count($telefoni); $i++) {
            if (!empty($telefoni[$i]['idTelefon']) && !empty($telefoni[$i]['telefon'])) {
                $this->ModelKorisnik->promeniTelefon($telefoni[$i]['idTelefon'], $telefoni[$i]['telefon']);
            } elseif (!empty($telefoni[$i]['idTelefon']) && empty($telefoni[$i]['telefon'])) {
                $this->ModelKorisnik->obrisiTelefon($telefoni[$i]['idTelefon']);
            } elseif (empty($telefoni[$i]['idTelefon']) && !empty($telefoni[$i]['telefon'])) {
                $this->ModelKorisnik->dodatTelefonPartnera($telefoni[$i]['telefon'], $partner['idPartner']);
            }
        }
        for ($i = 1; $i <= 5; $i++) {
            $email[$i] = array(
                'email' => $this->input->post('email' . $i),
                'idEmail' => $this->input->post('emailId' . $i)
            );
        }
        for ($i = 1; $i <= count($email); $i++) {
            if (!empty($email[$i]['idEmail']) && !empty($email[$i]['email'])) {
                $this->ModelKorisnik->promeniEmail($email[$i]['idEmail'], $email[$i]['email']);
            } elseif (!empty($email[$i]['idEmail']) && empty($email[$i]['email'])) {
                $this->ModelKorisnik->obrisiEmail($email[$i]['idEmail']);
            } elseif (empty($email[$i]['idEmail']) && !empty($email[$i]['email'])) {
                $this->ModelKorisnik->dodatEmailPartnera($email[$i]['email'], $partner['idPartner']);
            }
        }

        $kompanija = $partner['naziv'];
        redirect("$this->kontroler/dosije/" . $kompanija);
    }

    public function oglasDetaljnije($idOglas) {
        $oglas = $this->ModelKorisnik->iscitajOglas($idOglas);
        $fajl = $this->ModelKorisnik->iscitajOglasFajl($idOglas);
        $data['oglas'] = $oglas;
        $data['fajl'] = $fajl;
        $this->loadView("oglasDetaljnije.php", $data);
    }

    public function predavanjeDetaljnije($idpredavanje) {
        $predavanje = $this->ModelGost->iscitajPredavanje($idpredavanje);
        $data['predavanje'] = $predavanje;
        $this->loadView("predavanjeDetaljnije.php", $data);
    }

    public function mojProfil() {
        $data['kontroler'] = $this->kontroler;
        $this->loadView("mojProfil.php", $data);
    }

    public function promeniPassword($poruka = null) {
        $data['poruka'] = $poruka;
        $data['kontroler'] = $this->kontroler;
        $this->loadView("promeniPassword.php", $data);
    }

    public function menjajPassword() {
        $idKorisnik = $this->session->korisnik->idKorisnik;
        $username = $this->session->korisnik->username;
        $stari_password = $this->session->korisnik->password;
        if (($username == $this->input->post('username')) && ($stari_password == $this->input->post('stari_password')) && ($stari_password != $this->input->post('novi_password'))) {
            $novi_password = $this->input->post('novi_password');
            $this->ModelKorisnik->promeniPassword($idKorisnik, $novi_password);
            $this->logout();
        } elseif ($username != $this->input->post('username')) {
            $poruka = "Pogresan username!";
            $this->promeniPassword($poruka);
        } elseif ($stari_password != $this->input->post('stari_password')) {
            $poruka = "Pogresan stari password!";
            $this->promeniPassword($poruka);
        } elseif ($stari_password == $this->input->post('novi_password')) {
            $poruka = "Novi password ne sme da bude isti kao stari password!";
            $this->promeniPassword($poruka);
        }
    }

}
