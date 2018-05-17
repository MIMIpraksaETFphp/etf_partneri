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
}
