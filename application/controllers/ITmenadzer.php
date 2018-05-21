<?php

require_once APPPATH . 'controllers\Korisnik.php';

class ITmenadzer extends Korisnik {

    public function __construct() {
        parent::__construct();
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_ITmenadzer.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function korisnici() {
        $this->loadView("partneriClanovi.php");
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler'] = 'ITmenadzer';
        $data['predavanja'] = $predavanja;
        $this->loadView("predavanja.php", $data);
    }

    public function Clanovi() {
        echo "Clanovi";
    }

    public function novcaniUgovori() {
        $data['kontroler'] = 'ITmenadzer';
        $data['model'] = 'ModelKorisnik';
        $novcaniUgovori = $this->ModelKorisnik->ispisNovcanihUgovora();
        $data['novcaniUgovori'] = $novcaniUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $this->loadView("novcaniUgovori.php", $data);
    }

    public function dodavanjeNovcanogUgovora() {
//        $this->form_validation->set_rules("naziv", "naziv", "required");
//        $this->form_validation->set_rules("datum_potpisivanja", "datum_potpisivanja", "required");
//        $this->form_validation->set_rules("datum_isticanja", "datum_isticanja", "required");
//        $this->form_validation->set_rules("naziv_paketa", "naziv_paketa", "required");
//        $this->form_validation->set_rules("vrednost", "vrednost", "required");
//        $this->form_validation->set_rules("valuta", "valuta", "required");
//        $this->form_validation->set_rules("faktura", "faktura", "required");
//        $this->form_validation->set_rules("uplata", "uplata", "required");
//        $this->form_validation->set_rules("datum_uplate", "datum_uplate", "required");
//        $this->form_validation->set_rules("opis", "opis", "required");
//        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
//        if ($this->form_validation->run() == FALSE) {
//            $this->dodajNovcaniUgovor();
//        } else {
        $faktura = $this->input->post('faktura');
        $uplata = $this->input->post('uplata');
        if ($faktura == NULL)
            $faktura = 0;
        if ($uplata == NULL)
            $uplata = 0;
        $id_paketa = $this->input->post('id_paketa');
        $id_partnera = $this->input->post('id_partnera');
        $novcaniUgovor = array(
            'naziv' => $this->input->post('naziv'),
            'datum_potpisivanja' => $this->input->post('datum_potpisivanja'),
            'datum_isticanja' => date("Y-m-d H:i:s", strtotime("+3 months", strtotime($this->input->post('datum_potpisivanja')))), //todo promeni u bazi iz datetime u date, i promeni ovde isto
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
        if ($id_paketa == '1' || $id_paketa == '2') {
            $novcaniUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+24 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '3' || $id_paketa == '4') {
            $novcaniUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '5') {
            $novcaniUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+6 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '6') {
            $novcaniUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+3 months", strtotime($this->input->post('datum_potpisivanja'))));
        }
        $insertovanidNovcaniUgovor = $this->ModelKorisnik->dodatUgovor($novcaniUgovor);
        $this->ModelKorisnik->dodatNovcaniUgovor($novcaniUgovor, $insertovanidNovcaniUgovor);
        //   }
        redirect("ITmenadzer/novcaniUgovori");

        // }   
    }

    public function dodajUgovor() {
        $partneriUgovori = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriUgovori'] = $partneriUgovori;
        $paketiUgovori = $this->ModelKorisnik->paketIdNaziv();
        $data['paketiUgovori'] = $paketiUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $this->loadView("dodajNovcaniUgovor.php", $data);
    }

    public function index() {
        $partnerIsticeUgovor = $this->ModelKorisnik->iscitajPartnera();
        $iscitajPredavanje = $this->ModelKorisnik->iscitajPredavanje();
        $iscitajOglase = $this->ModelKorisnik->iscitajOglase();
        //$iscitajOglas=$this->ModelKorisnik->iscitajOglas();
        $data['iscitajOglase'] = $iscitajOglase;
        $data['iscitajPredavanje'] = $iscitajPredavanje;
        $data['partnerIsticeUgovor'] = $partnerIsticeUgovor;
        //$data['iscitajOglas']=$iscitajOglas;
        $data['kontroler'] = 'ITmenadzer';
        $this->loadView('ITindex.php', $data);
    }

    public function part() {
        //prekopirana funkcija index iz Korisnik...
        $data['kontroler'] = 'Korisnik';
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

    public function donatorskiUgovori() {
        $data['kontroler'] = 'ITmenadzer';
        $data['model'] = 'ModelKorisnik';
        $donatorskiUgovori = $this->ModelKorisnik->ispisDonatorskihUgovora();
        $data['donatorskiUgovori'] = $donatorskiUgovori;
        $this->loadView("donatorskiUgovori.php", $data);
    }

    public function oglasi() {
        $data['kontroler'] = 'ITmenadzer';
        $data['oglasi'] = $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function oglasDetaljnije($idOglas) {
        //$data['kontroler']='ITmenadzer';
        $oglas = $this->ModelKorisnik->iscitajOglas($idOglas);
        $data['oglas'] = $oglas;
        $this->loadView("oglasDetaljnije.php", $data);
    }

    public function predavanjeDetaljnije($idpredavanje) {
        $predavanje = $this->ModelKorisnik->iscitajPredavanja($idpredavanje);
        $data['predavanje'] = $predavanje;
        $this->loadView("predavanjeDetaljnije.php", $data);
    }

    public function dodajUgovorDonacije() {
        $partneriUgovori = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriUgovori'] = $partneriUgovori;
        $paketiUgovori = $this->ModelKorisnik->paketIdNaziv();
        $data['paketiUgovori'] = $paketiUgovori;
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
        $this->loadView("dodajDonatorskiUgovor.php", $data);
    }

    public function dodavanjeDonatorskogUgovora() {
//        $this->form_validation->set_rules("naziv", "naziv", "required");
//        $this->form_validation->set_rules("datum_potpisivanja", "datum_potpisivanja", "required");
//        $this->form_validation->set_rules("datum_isticanja", "datum_isticanja", "required");
//        $this->form_validation->set_rules("naziv_paketa", "naziv_paketa", "required");
//        $this->form_validation->set_rules("procenjena_vrednost", "procenjena_vrednost", "required");
//        $this->form_validation->set_rules("valuta", "valuta", "required");
//        $this->form_validation->set_rules("opis_donacije", "opis_donacije", "required");
//        $this->form_validation->set_rules("datum_isporuke", "datum_isporuke", "required");
//        $this->form_validation->set_rules("opis", "opis", "required");
//        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
//        if ($this->form_validation->run() == FALSE) {
//            $this->dodajUgovorDonacije();
//        } else {
        $id_paketa = $this->input->post('id_paketa');
        $id_partnera = $this->input->post('id_partnera');
        $donatorskiUgovor = array(
            'naziv' => $this->input->post('naziv'),
            'datum_potpisivanja' => $this->input->post('datum_potpisivanja'),
            'datum_isticanja' => date("Y-m-d H:i:s", strtotime("+3 months", strtotime($this->input->post('datum_potpisivanja')))), //todo promeni u bazi iz datetime u date, i promeni ovde isto
            'id_paketa' => $id_paketa,
            'id_partnera' => $id_partnera,
            'procenjena_vrednost' => $this->input->post('procenjena_vrednost'),
            'valuta' => $this->input->post('valuta'),
            'opis_donacije' => $this->input->post('opis_donacije'),
            'datum_isporuke' => $this->input->post('datum_isporuke'),
            'opis' => $this->input->post('idstatus_ugovora'),
            'tip' => 'donatorski'
        );
        if ($id_paketa == '1' || $id_paketa == '2') {
            $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+24 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '3' || $id_paketa == '4') {
            $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '5') {
            $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+6 months", strtotime($this->input->post('datum_potpisivanja'))));
        } elseif ($id_paketa == '6') {
            $donatorskiUgovor['datum_isticanja'] = date("Y-m-d H:i:s", strtotime("+3 months", strtotime($this->input->post('datum_potpisivanja'))));
        }
        $insertovanidDonatorskiUgovor = $this->ModelKorisnik->dodatUgovorDonacije($donatorskiUgovor);
        $this->ModelKorisnik->dodatDonatorskiUgovor($donatorskiUgovor, $insertovanidDonatorskiUgovor);
        redirect("ITmenadzer/donatorskiUgovori");
        //   }
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
        $this->ModelKorisnik->promeniStatusNUgovora($statusUgovora, $idUgovor);

        redirect("ITmenadzer/novcaniUgovori");
    }

}
