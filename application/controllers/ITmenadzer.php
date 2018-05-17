<?php

require_once APPPATH . 'controllers\Korisnik.php';

class ITmenadzer extends Korisnik{
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

    public function novcani_Ugovori() {
        echo "Novcani ugovori";
    }
    
    public function donatorskiUgovori() {
        echo "Donatorski ugovori";
    }
    
    public function Clanovi() {
        echo "Clanovi";
    }
    
    public function novcaniUgovori() {
        $data['kontroler']='ITmenadzer';
        $data['model']='ModelKorisnik';
        $novcaniUgovori = $this->ModelKorisnik->ispisNovcanihUgovora();
        $data['novcaniUgovori']=$novcaniUgovori;
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
            $novcaniUgovor = array(
                'naziv' => $this->input->post('naziv'),
                'datum_potpisivanja' => $this->input->post('datum_potpisivanja'),
                'datum_isticanja' => $this->input->post('datum_isticanja'),
                'id_paketa' => $this->input->post('id_paketa'),
                'id_partnera' => $this->input->post('id_partnera'),
                'vrednost' => $this->input->post('vrednost'),
                'valuta' => $this->input->post('valuta'),
                'faktura' => $this->input->post('faktura'),
                'uplata' => $this->input->post('uplata'),
                'datum_uplate' => $this->input->post('datum_uplate'),
                'opis' => '1'
            );

            $insertovanidNovcaniUgovor = $this->ModelKorisnik->dodatUgovor($novcaniUgovor);

                    $this->ModelKorisnik->dodatNovcaniUgovor($novcaniUgovor, $insertovanidNovcaniUgovor);
         //   }
//            redirect("ITmenadzer/dodajNovcaniUgovor");        
    
        
    }
    
    public function dodajUgovor() {
        $partneriUgovori = $this->ModelKorisnik->partnerIdNaziv();
        $data['partneriUgovori'] = $partneriUgovori;
        $paketiUgovori = $this->ModelKorisnik->paketIdNaziv();
        $data['paketiUgovoroi'] = $partneriUgovori;
        $this->loadView("dodajNovcaniUgovor.php", $data);
    }

    public function index(){
        $partnerIsticeUgovor= $this->ModelKorisnik->iscitajPartnera();
        $data['partnerIsticeUgovor']=$partnerIsticeUgovor;
        $this->loadView('ITindex.php',$data);
    }
    
    public function part(){
        //prekopirana funkcija index iz Korisnik...
        $data['kontroler'] = 'Korisnik';
        $data['metoda'] = 'index';
        $limit = 2;
        $pocetni_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($this->input->get('pronadji')=='Pronadji'){
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

}
