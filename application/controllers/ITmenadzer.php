<?php

require_once APPPATH . 'controllers/Korisnik.php';

class ITmenadzer extends Korisnik {

    public $kontroler = 'ITmenadzer';

    public function __construct() {
        parent::__construct();
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_ITmenadzer.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function filtrirajClanove($clan, $partneri) {
        $filter = array($clan['username']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['username'], $filter);
        });
        return $filtriraniPartneri;
    }

    public function clanovi() {
        $data['kontroler'] = $this->kontroler;
        $clanovi = $this->ModelKorisnik->dohvatiClanove();
        $data['clanovi'] = $clanovi;
        $partneri = $this->ModelKorisnik->dohvatiPartnere();
//        $data['partneri']=$partneri;
        foreach ($clanovi as $clan) {
            //$imeClana = $clan['ime'];
            // $prezimeClana = $clan['prezime'];
            $usernameClana = $clan['username'];
            // $idClana = $clan['idKorisnik'];
            $data['partneri'][$usernameClana] = $this->filtrirajClanove($clan, $partneri);
        }
        $partner = $this->ModelKorisnik->partnerIdNaziv();
        $data['partner'] = $partner;

        $this->loadView("clanovi.php", $data);
    }

    public function novcaniUgovori() {
        $data['kontroler'] = $this->kontroler;
        $novcaniUgovori = $this->ModelKorisnik->ispisNovcanihUgovora();
        $data['novcaniUgovori'] = $novcaniUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $this->loadView("novcaniUgovori.php", $data);
    }

    public function dodavanjeNovcanogUgovora() {
        $this->form_validation->set_rules("datum_potpisivanja", "Datum potpisivanja", "required");
        $this->form_validation->set_rules("vrednost", "Vrednost", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajUgovor();
        } else {
            $faktura = $this->input->post('faktura');
            $uplata = $this->input->post('uplata');
            if ($faktura == NULL) {
                $faktura = 0;
            }
            if ($uplata == NULL) {
                $uplata = 0;
            }
            $id_paketa = $this->input->post('id_paketa');
            $id_partnera = $this->input->post('id_partnera');
            $novcaniUgovor = array(
                'naziv' => $this->input->post('naziv'),
                'datum_potpisivanja' => $this->input->post('datum_potpisivanja'),
                'id_paketa' => $id_paketa,
                'id_partnera' => $id_partnera,
                'vrednost' => $this->input->post('vrednost'),
                'valuta' => $this->input->post('valuta'),
                'faktura' => $faktura,
                'uplata' => $uplata,
                'datum_uplate' => $this->input->post('datum_uplate'),
                'opis' => $this->input->post('idstatus_ugovora'),
                'tip' => 'novcani'
            );
            $broj= $this->ModelKorisnik->brojPaketa();
            for ($i = 1; $i <= $broj; $i++) {
                if ($id_paketa == $i) {
                    $godinePaket = $this->ModelKorisnik->godinePaket($id_paketa);
                    $godina = $godinePaket['trajanje_paketa_godine'];
                    $novcaniUgovor['datum_isticanja'] = date("Y-m-d", strtotime("+$godina years", strtotime($this->input->post('datum_potpisivanja'))));
                }
            }
            $brojPartneraPoPaketu = $this->ModelKorisnik->brojPartneraPoPaketu($novcaniUgovor['id_paketa']);
            if ($brojPartneraPoPaketu != NULL) {
                if ($brojPartneraPoPaketu[0]['broj'] < $brojPartneraPoPaketu[0]['maks_broj_partnera']) {
                    $insertovanidNovcaniUgovor = $this->ModelKorisnik->dodatUgovor($novcaniUgovor);
                    $this->ModelKorisnik->dodatNovcaniUgovor($novcaniUgovor, $insertovanidNovcaniUgovor);
                    $message = "Uspešno ste dodali novi Ugovor.";
                    $boja = "blue";
                    $this->dodajUgovor($message, $boja);
                } else {
                    $message = "Iskorišćen je maksimalni broj Partnera u Paketu!";
                    $boja = "red";
                    $this->dodajUgovor($message, $boja);
                }
            } else {
                $this->dodajUgovor();
            }
        }
    }

    public function dodajUgovor($message = NULL, $boja = NULL) {
        if ($message != NULL && $boja != NULL) {
            $data['message'] = $message;
            $data['boja'] = $boja;
        }
        $data['kontroler'] = $this->kontroler;
        $partneriUgovori = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriUgovori'] = $partneriUgovori;
        $paketiUgovori = $this->ModelKorisnik->paketIdNaziv();
        $data['paketiUgovori'] = $paketiUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $brojPartnera = $this->ModelKorisnik->brojPartneraPaket();
        $data['brojPartnera'] = $brojPartnera;
        $this->loadView("dodajNovcaniUgovor.php", $data);
    }

    public function index() {
        $data['kontroler'] = $this->kontroler;
        $partnerIsticeUgovor = $this->ModelKorisnik->iscitajPartnera();
        $iscitajPredavanje = $this->ModelKorisnik->iscitajPredavanje();
        $iscitajOglase = $this->ModelKorisnik->iscitajOglase();
        $data['iscitajOglase'] = $iscitajOglase;
        $data['iscitajPredavanje'] = $iscitajPredavanje;
        $data['partnerIsticeUgovor'] = $partnerIsticeUgovor;
        $this->loadView('ITindex.php', $data);
    }

    public function part() {
        //prekopirana funkcija index iz Korisnik...
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
        $config_pagination['base_url'] = site_url("$this->kontroler/part");
        $config_pagination['total_rows'] = $ukupanBrPartnera;
        $config_pagination['per_page'] = $limit;
        $config_pagination['next_link'] = 'Next';
        $config_pagination['prev_link'] = 'Prev';

        $this->pagination->initialize($config_pagination);
        $data['links'] = $this->pagination->create_links();

        $this->loadView("partneriClanovi.php", $data);
    }

    public function donatorskiUgovori() {
        $data['kontroler'] = $this->kontroler;
        $donatorskiUgovori = $this->ModelKorisnik->ispisDonatorskihUgovora();
        $data['donatorskiUgovori'] = $donatorskiUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $this->loadView("donatorskiUgovori.php", $data);
    }

    public function dodajUgovorDonacije($message = NULL, $boja = NULL) {
        if ($message != NULL && $boja != NULL) {
            $data['message'] = $message;
            $data['boja'] = $boja;
        }
        $data['kontroler'] = $this->kontroler;
        $partneriUgovori = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriUgovori'] = $partneriUgovori;
        $paketiUgovori = $this->ModelKorisnik->paketIdNaziv();
        $data['paketiUgovori'] = $paketiUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $brojPartnera = $this->ModelKorisnik->brojPartneraPaket();
        $data['brojPartnera'] = $brojPartnera;
        $this->loadView("dodajDonatorskiUgovor.php", $data);
    }

    public function dodavanjeDonatorskogUgovora() {
        $this->form_validation->set_rules("datum_potpisivanja", "Datum potpisivanja", "required");
        $this->form_validation->set_rules("procenjena_vrednost", "Procenjena vrednost", "required");
        $this->form_validation->set_rules("opis_donacije", "Opis donacije", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajUgovorDonacije();
        } else {
            $id_paketa = $this->input->post('id_paketa');
            $id_partnera = $this->input->post('id_partnera');
            $donatorskiUgovor = array(
                'naziv' => $this->input->post('naziv'),
                'datum_potpisivanja' => $this->input->post('datum_potpisivanja'),
                // 'datum_isticanja' => date("Y-m-d H:i:s", strtotime("+3 months", strtotime($this->input->post('datum_potpisivanja')))), //todo promeni u bazi iz datetime u date, i promeni ovde isto
                'id_paketa' => $id_paketa,
                'id_partnera' => $id_partnera,
                'procenjena_vrednost' => $this->input->post('procenjena_vrednost'),
                'valuta' => $this->input->post('valuta'),
                'opis_donacije' => $this->input->post('opis_donacije'),
                'datum_isporuke' => $this->input->post('datum_isporuke'),
                'opis' => $this->input->post('idstatus_ugovora'),
                'komentar' => $this->input->post('komentar'),
                'tip' => 'donatorski'
            );
            // if ($id_paketa == '1' || $id_paketa == '2' || $id_paketa == '3') {
            //     $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+24 months", strtotime($this->input->post('datum_potpisivanja'))));
            // } elseif ($id_paketa == '4' || $id_paketa == '5' || $id_paketa == '6') {
            //     $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($this->input->post('datum_potpisivanja'))));
            // }

            $broj= $this->ModelKorisnik->brojPaketa();
            for ($i = 1; $i <= $broj; $i++) {
                if ($id_paketa == $i) {
                    $godinePaket = $this->ModelKorisnik->godinePaket($id_paketa);
                    $godina = $godinePaket['trajanje_paketa_godine'];
                    $donatorskiUgovor['datum_isticanja'] = date("Y-m-d", strtotime("+$godina years", strtotime($this->input->post('datum_potpisivanja'))));
                }
            }
            $brojPartneraPoPaketu = $this->ModelKorisnik->brojPartneraPoPaketu($donatorskiUgovor['id_paketa']);
            if ($brojPartneraPoPaketu != NULL) {
                if ($brojPartneraPoPaketu[0]['broj'] < $brojPartneraPoPaketu[0]['maks_broj_partnera']) {
                    $insertovanidDonatorskiUgovor = $this->ModelKorisnik->dodatUgovorDonacije($donatorskiUgovor);
                    $this->ModelKorisnik->dodatDonatorskiUgovor($donatorskiUgovor, $insertovanidDonatorskiUgovor);
                    $message = "Uspešno ste dodali novi Ugovor.";
                    $boja = "blue";
                    $this->dodajUgovorDonacije($message, $boja);
                } else {
                    $message = "Iskorišćen je maksimalni broj Partnera u Paketu!";
                    $boja = "red";
                    $this->dodajUgovorDonacije($message, $boja);
                }
            } else {
                $this->dodajUgovorDonacije();
            }
//            $insertovanidDonatorskiUgovor = $this->ModelKorisnik->dodatUgovorDonacije($donatorskiUgovor);
//            $this->ModelKorisnik->dodatDonatorskiUgovor($donatorskiUgovor, $insertovanidDonatorskiUgovor);
//            redirect("$this->kontroler/donatorskiUgovori");
            
        }
    }

    public function promeniPodatkeUgovora() {
        $idUgovor = $this->input->get('idUgovor');
        $faktura = $this->input->get('faktura');
        if ($faktura == NULL) {
            $faktura = 0;
        }
        $uplata = $this->input->get('uplata');
        if ($uplata == NULL) {
            $uplata = 0;
        }
        $datumUplate = $this->input->get('datum_uplate');
        $statusUgovora = $this->input->get('status_ugovora');
        $komentar = $this->input->get('komentar');
        $this->ModelKorisnik->promeniNUgovor($faktura, $uplata, $datumUplate, $komentar, $idUgovor);
        $this->ModelKorisnik->promeniStatusUgovora($statusUgovora, $idUgovor);

        redirect("$this->kontroler/novcaniUgovori");
    }

    public function mejl($data = []) {

        $data['kontroler'] = $this->kontroler;
        $this->loadView("mejl.php", $data);


        //     $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'smtp.mail.yahoo.com',
        //     'smtp_user' => 'majtic@yahoo.com',
        //     'smtp_pass' => 'sifra123',
        //     'smtp_port' => 465,
        //     'mailtype' => 'html',
        //     'charset' => 'iso-8859-1',
        //     'wordwrap' => TRUE
        //     );
        // //    $this->email->initialize($config);
        //     $this->load->library('email', $config);
        //     $this->email->from('majtic@yahoo.com', 'Milan');
        //     $this->email->to('milanajtic@gmail.com');
        //     $this->email->subject('asdddasd');
        //     $this->email->message('Radi!!!');
        //     $this->email->set_newline('\r\n');
        //     $this->email->send();
        //     $this->email->print_debugger();
    }

    public function saljiMejl() {
        $this->form_validation->set_rules("to", "TO", "required|callback_testAdrese");
        $this->form_validation->set_rules("cc", "CC", "callback_testAdrese");
        $this->form_validation->set_rules("bcc", "BCC", "callback_testAdrese");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->mejl();
        } else {
            $this->load->library('email');
            // $from = $this->input->post('from');
            $from = $this->session->korisnik->email;
            $to = $this->input->post('to');
            $cc = $this->input->post('cc');
            $bcc = $this->input->post('bcc');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $datum = $this->input->post('datum_slanja');

            // Get full html:
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                <title>' . html_escape($subject) . '</title>
                <style type="text/css">
                    body {
                        font-family: Arial, Verdana, Helvetica, sans-serif;
                        font-size: 16px;
                    }
                </style>
            </head>
            <body>
            ' . $message . '
            </body>
            </html>';
            // Also, for getting full html you may use the following internal method:
            //$body = $this->email->full_html($subject, $message);

            $result = $this->email
                    ->from($from)
                    ->reply_to($from)    // Optional, an account where a human being reads.
                    ->to($to)
                    ->cc($cc)
                    ->bcc($bcc)
                    ->subject($subject)
                    ->message($body)
                    ->send();
            if ($result) {
                $data['poruka'] = "Mejl je uspešno poslat.";
                $adrese = $to;
                if (!empty($cc)) {
                    $adrese = $adrese . "," . $cc;
                }
                if (!empty($bcc)) {
                    $adrese = $adrese . "," . $bcc;
                }
                // $adrese = preg_replace("/,+/", ",", $adrese);   // pretvara vise zareza u jedan zarez
                $adrese = preg_replace("/[, ]+/", ",", $adrese);        // pretvara zareze i razmake u jedan zarez
                $adrese = trim($adrese, ',');
                $adreseNiz = explode(",", $adrese);
                $idKorisnik = $this->session->korisnik->idKorisnik;
                $insertovaniIdMejla = $this->ModelKorisnik->dodajMejl($subject, $message, $datum, $idKorisnik);
                for ($i = 0; $i < count($adreseNiz); $i++) {
                    if ($this->ModelKorisnik->proveraIdenticnaMejlAdresa($adreseNiz[$i], $insertovaniIdMejla)) {
                        $this->ModelKorisnik->dodajPrimaocaMejla($adreseNiz[$i], $insertovaniIdMejla);
                    }
                }
                $data['adreseNiz'] = $adreseNiz;            // zbog var_dump
            } else {
                $data['poruka'] = "Mejl nije poslat.";
            }
            $this->loadview('status.php', $data);
        }
    }

    public function testAdrese($adresa) {
        if (preg_match("/^\s*(([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)(\s*,\s*|\s*$))*$/", $adresa)) {
            return true;
        } else {
            $this->form_validation->set_message("testAdrese", '{field} nije u ispravnom obliku, morate uneti mejl adrese razdvojene jednim zarezom');
            return false;
        }
    }

    public function promeniPodatkeDonatorskihUgovora() {
        $idUgovor = $this->input->get('idUgovor');
        $opisDonacije = $this->input->get('opis_donacije');
        $isporuka = $this->input->get('isporuka');
        if ($isporuka == NULL) {
            $isporuka = 0;
        }
        $datumIsporuke = $this->input->get('datum_isporuke');
        $statusUgovora = $this->input->get('status_ugovora');
        $komentar = $this->input->get('komentar');
        $this->ModelKorisnik->promeniDUgovor($opisDonacije, $isporuka, $datumIsporuke, $komentar, $idUgovor);
        $this->ModelKorisnik->promeniStatusUgovora($statusUgovora, $idUgovor);

        redirect("$this->kontroler/donatorskiUgovori");
    }

    public function izbrisiPartnerClan($idKorisnik, $idPartner) {
        $this->ModelKorisnik->izbrisiPartnerClan($idKorisnik, $idPartner);
        redirect("$this->kontroler/clanovi");
    }

    public function dodavanjePartneraClanu() {
        $this->form_validation->set_rules("id_partnera", "id_partnera", "callback_proveraKorisnikPartner");
        $this->form_validation->set_message("proveraKorisnikPartner", "Taj član je vec zadužen za tu kompaniju");
        if ($this->form_validation->run() == false) {
            $this->clanovi();   // kad se prikazuje form_error, mora ovako, ne sme redirect!
        } else {
            $partnerClan = array(
                'partner_idPartner' => $this->input->post('id_partnera'),
                'korisnik_idKorisnik' => $this->input->post('idKorisnika')
            );
            $this->ModelKorisnik->dodavanjePartneraClanu($partnerClan);
            redirect("$this->kontroler/clanovi");
        }
    }

    public function proveraKorisnikPartner() {
        $korisnik = $this->input->post('idKorisnika');
        $partner = $this->input->post('id_partnera');
        $status = $this->ModelKorisnik->proveraKorisnikPartner($korisnik, $partner);
        return $status;
    }

    public function posaljiOglasMejlom($idoglas) {
        $oglas = $this->ModelKorisnik->iscitajOglas($idoglas);
        $data['subject'] = $oglas['naziv'];
        $data['message'] = $oglas['opis'];
        $this->mejl($data);
    }

    public function posaljiPredavanjeMejlom($idpredavanje) {
        $predavanje = $this->ModelKorisnik->iscitajPredavanja($idpredavanje);
        $data['subject'] = $predavanje['naslov_srpski'];
        $data['message'] = $predavanje['opis_srpski'];
        $this->mejl($data);
    }

    public function posaljiMejlPartneruKomeIsticeUgovor($idPartner) {
        $partner = $this->ModelKorisnik->dohvatiPartnera($idPartner);
        $data['subject'] = "Produženje saradnje sa ETF-om";
        $data['to'] = $partner['email_kontakt_osobe'];
        $this->mejl($data);
    }

    public function ispisNovcanihUgovoraArhiva() {
        $NovUgovor = $this->ModelKorisnik->ispisNovcanihUgovoraArhiva();
        $data['NovUgovor'] = $NovUgovor;
        $this->loadView("arhivaNovcanihUgovora.php", $data);
    }

    public function ispisDonatorskihUgovoraArhiva() {
        $DonUgovor = $this->ModelKorisnik->ispisDonatorskihUgovoraArhiva();
        $data['DonUgovor'] = $DonUgovor;
        $this->loadView("arhivaDonatorskihUgovora.php", $data);
    }

    public function arhivaMejl() {
        $data['mejlovi'] = $this->ModelKorisnik->ispisMejlova();
        $brojMejlova = $this->ModelKorisnik->brojMejlova();
        for ($i=1;$i<$brojMejlova+1;$i++){
            $primaociMejla[$i] = $this->ModelKorisnik->ispisPrimalacaMejlova($i);
        }
        if(!empty($primaociMejla)){
            $data['primaociMejla'] = $primaociMejla;
        }
        $data['kontroler'] = $this->kontroler;
        $this->loadView("arhivaMejl.php", $data);
    }

}
