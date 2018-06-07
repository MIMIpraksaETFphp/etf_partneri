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

            $this->posaljiMejlObavestenjeOglas($oglas);
        }
    }

    public function posaljiMejlObavestenjeOglas($oglas) {
        $podaci['idPartner'] = $oglas['id_partnera'];
        $primaociMejla = $this->ModelKorisnik->dohvatiPartnere($podaci);
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
            $data['poruka'] = "Mejl obavestenje je uspesno poslato.";
        } else {
            $data['poruka'] = "Mejl obavestenje nije uspesno poslato.";
        }

        $this->loadView("status.php", $data);
    }

    public function index() {
        $idKorisnik = $this->session->korisnik->idKorisnik;
        $danasnjiDatum = mdate('%Y-%m-%d', now());
        $petIsticanja=$this->ModelKorisnik->iscitajPetKompanijaIsticanje($danasnjiDatum);
        $petPotpisivanja=$this->ModelKorisnik->iscitajPetKompanijaPotpisivanje($danasnjiDatum);
        $clanoviUgovor = $this->ModelKorisnik->clanImaUgovor($idKorisnik);
        $data['clanoviUgovor'] = $clanoviUgovor;
        $data['petIsticanja']=$petIsticanja;
        $data['petPotpisivanja']=$petPotpisivanja;
        $this->loadView("ClanTimaIndex.php", $data);
    }
    
    public function part() {
        $data['kontroler'] = $this->kontroler;
        $data['metoda'] = 'part';
        $limit = 10;
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
            $this->session->unset_userdata('kompanija');
            $this->session->unset_userdata('paket');
            $vazeciUgovor = $this->input->get('vazeciUgovor');
            $this->session->set_userdata('vazeciUgovor', $vazeciUgovor);
        } elseif ($this->session->userdata('vazeciUgovor')) {
            $vazeciUgovor = $this->session->userdata('vazeciUgovor');
        }

        $rezultat = $this->ModelKorisnik->pretragaPartnera($limit, $pocetni_index, $vazeciUgovor, $kompanija, $paket);
        $data['rezultat'] = $rezultat;
        $ukupanBrPartnera = $this->ModelKorisnik->brojPartnera($kompanija, $paket, $vazeciUgovor);
        $data['ukupanBroj'] = $ukupanBrPartnera;

        $this->config->load('bootstrap_pagination');
        $config_pagination = $this->config->item('pagination');
        $config_pagination['base_url'] = site_url("Korisnik/part");
        $config_pagination['total_rows'] = $ukupanBrPartnera;
        $config_pagination['per_page'] = $limit;
        $config_pagination['next_link'] = 'Next';
        $config_pagination['prev_link'] = 'Prev';

        $this->pagination->initialize($config_pagination);
        $data['links'] = $this->pagination->create_links();

        $this->loadView("partneriClanovi.php", $data);
    }

    public function dodajOglas() {
        $data['kontroler'] = $this->kontroler;

        $podaci['idKorisnik'] = $this->session->korisnik->idKorisnik;
        if($this->session->korisnik->status_korisnika_idtable1==2){
            $partneriKorisnika = $this->ModelKorisnik->dohvatiPartnere($podaci);
        }
        else{
            $partneriKorisnika = $this->ModelKorisnik->dohvatiPartnere();
        }
        $data['partneriKorisnika'] = $partneriKorisnika;

        $this->loadView("dodajOglas.php", $data);
    }

    public function dodajPredavanje() {
        $data['kontroler'] = $this->kontroler;

        $podaci['idKorisnik'] = $this->session->korisnik->idKorisnik;
        if($this->session->korisnik->status_korisnika_idtable1==2){
            $partneriKorisnika = $this->ModelKorisnik->dohvatiPartnere($podaci);
        }
        else{
            $partneriKorisnika = $this->ModelKorisnik->dohvatiPartnere();
        }
        $data['partneriKorisnika'] = $partneriKorisnika;

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
        $data['metoda'] = 'partneri';
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
        $this->form_validation->set_rules("naziv", "Naziv", "required");
        $this->form_validation->set_rules("adresa", "Adresa", "required");
        $this->form_validation->set_rules("postanski_broj", "Postanski broj", "required");
        $this->form_validation->set_rules("grad", "Grad", "required");
        $this->form_validation->set_rules("drzava", "Drzava", "required");
        $this->form_validation->set_rules("ziro_racun", "Žiro racun", "required");
        $this->form_validation->set_rules("valuta_racuna", "Valuta racuna", "required");
        $this->form_validation->set_rules("PIB", "PIB", "required");
        $this->form_validation->set_rules("telefon1", "Telefon", "required|min_length[9]");
        $this->form_validation->set_rules("email1", "Email", "required|valid_email");
        $this->form_validation->set_rules("opis", "Opis", "required");
        $this->form_validation->set_rules("veb_adresa", "Veb adresa", "required");
        $this->form_validation->set_rules("ime_kontakt_osobe", "Ime kontakt osobe", "required");
        $this->form_validation->set_rules("prezime_kontakt_osobe", "Prezime kontakt osobe", "required");
        $this->form_validation->set_rules("telefon_kontakt_osobe", "Telefon kontakt osobe", "required");
        $this->form_validation->set_rules("email_kontakt_osobe", "Email kontakt osobe", "required|valid_email");
        if (empty($_FILES['logo']['name'])) {
            $this->form_validation->set_rules('logo', 'Logo', 'required');
        }
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
            $idKorisnik= $this->session->korisnik->idKorisnik;
            $this->ModelKorisnik->poveziKorisnikPartner($insertovanidPartnera,$idKorisnik);
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

//            $logo = $partner['naziv'];
            $logo = $this->upload->data('file_name');
            $putanja = 'assets/logo/' . $logo;
            $this->ModelKorisnik->dodatLogo($logo, $putanja, $insertovanidPartnera);
            //$data['tip'] = 'dodaj';

            // redirect("Korisnik/dodajKompaniju/" . $data);
            $this->index();
        }
    }

    public function dodavanjePredavanja() {
        $this->form_validation->set_rules("naslov_srpski", "Naslov srpski", "required");
        $this->form_validation->set_rules("opis_srpski", "Opis srpski", "required");
        $this->form_validation->set_rules("vreme_predavanja", "Vreme predavanja", "required");
        $this->form_validation->set_rules("sala", "Sala", "required");
        $this->form_validation->set_rules("ime_predavaca", "Ime predavaca", "required");
        $this->form_validation->set_rules("prezime_predavaca", "Prezime predavaca", "required");
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

            // $config['upload_path'] = './assets/fajlovi/';
            // $config['allowed_types'] = 'pdf|jpg|jpeg|png|tiff';
            // $config['file_name'] = $predavanje['naslov_srpski'] . "_" . $predavanje['ime_predavaca'] . $predavanje['prezime_predavaca'];
            // $this->load->library('upload', $config);
            // $this->upload->do_upload('fajl');

            $this->ModelKorisnik->dodatoPredavanje($predavanje);
            $this->posaljiMejlObavestenjePredavanje($predavanje);
            // redirect("$this->kontroler/predavanja");
        }
    }

    public function posaljiMejlObavestenjePredavanje($predavanje) {
        $podaci['idPartner'] = $predavanje['partner_idPartner'];
        $primaociMejla = $this->ModelKorisnik->dohvatiPartnere($podaci);
        $adresePrimalaca = [];
        foreach ($primaociMejla as $primalacMejla) {
            array_push($adresePrimalaca, $primalacMejla['email']);
        }
        // $data['adresePrimalaca'] = $adresePrimalaca;

        $this->load->library('email');
        $to = implode(",", $adresePrimalaca);
        $subject = "Dodato je predavanje sa naslovom: " . $predavanje['naslov_srpski'];
        $message = "Sadrzina predavanja: " . $predavanje['opis_srpski'];
        $result = $this->email
                ->from('no-reply@etf.rs')
                ->to($to)
                ->subject($subject)
                ->message($message)
                ->send();
        if ($result) {
            $data['poruka'] = "Mejl obavestenje je uspesno poslato.";
        } else {
            $data['poruka'] = "Mejl obavestenje nije uspesno poslato.";
        }

        $this->loadView("status.php", $data);
    }

    public function dosije($idPartner, $value = NULL) {
        $partner = $this->ModelKorisnik->dosijePartner($idPartner);
        $ugovori = $this->ModelKorisnik->pretragaUgovora($idPartner);
        $telefoni = $this->ModelKorisnik->pretragaTelefoni($idPartner);
        $mejlovi = $this->ModelKorisnik->pretragaMejlovi($idPartner);
        $logoi = $this->ModelKorisnik->pretragaLogo($idPartner);
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

        $idPartner = $partner['idPartner'];
        redirect("$this->kontroler/dosije/" . $idPartner);
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
        $podaci['idKorisnik'] = $this->session->korisnik->idKorisnik;
        $data['partneri'] = $this->ModelKorisnik->dohvatiPartnere($podaci);
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
        if (($username == $this->input->post('username')) && ($stari_password == md5($this->input->post('stari_password'))) && ($stari_password != md5($this->input->post('novi_password')))) {
            $novi_password = md5($this->input->post('novi_password'));
            $this->ModelKorisnik->promeniPassword($idKorisnik, $novi_password);
            $this->logout();
        } elseif ($username != $this->input->post('username')) {
            $poruka = "Pogresan username!";
            $this->promeniPassword($poruka);
        } elseif ($stari_password != md5($this->input->post('stari_password'))) {
            $poruka = "Pogresan stari password!";
            $this->promeniPassword($poruka);
        } elseif ($stari_password == md5($this->input->post('novi_password'))) {
            $poruka = "Novi password ne sme da bude isti kao stari password!";
            $this->promeniPassword($poruka);
        }
    }

}
