<?php

require_once APPPATH . 'controllers\Korisnik.php';

class ITmenadzer extends Korisnik {

    public function __construct() {
        parent::__construct();
        
//        if (($this->session->userdata('korisnik')) == NULL) 
//            redirect("Gost");
////        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2) 
////            redirect("korisnik");
////        elseif ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3) 
////            redirect("ITmenadzer");
//        elseif($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
//                redirect("Admin");
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

//    public function novcani_Ugovori() {
//        echo "Novcani ugovori";
//    }
//    
//    public function donatorski_Ugovori() {
//        echo "Donacije";
//    }
    
     public function filtrirajClanove($clan,$partneri){        
        $filter = array($clan['username']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['username'], $filter);
        });
        return $filtriraniPartneri;
    }
    
    public function clanovi() {
        $data['kontroler']='ITmenadzer';
        $data['model']='ModelKorisnik';
        $clanovi= $this->ModelKorisnik->dohvatiClanove();
        $data['clanovi']=$clanovi;
        $partneri= $this->ModelKorisnik->dohvatiPartnere();
//        $data['partneri']=$partneri;
        foreach ($clanovi as $clan){
                $imeClana=$clan['ime'];
                $prezimeClana=$clan['prezime'];
                $usernameClana=$clan['username'];
                $idClana=$clan['idKorisnik'];
                $data['partneri'][$usernameClana]=$this->filtrirajClanove($clan,$partneri);
            }
        $this->loadView("clanovi.php", $data);
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
        $this->loadView('ITindex.php',$data);        
    }

    public function part() {
        //prekopirana funkcija index iz Korisnik...
        $data['kontroler'] = 'ITmenadzer';
        $data['metoda'] = 'part';
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
        $config_pagination['base_url'] = site_url("ITmenadzer/part");
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
        $statusUgovor = $this->ModelKorisnik->statusIdUgovor();
        $data['statusUgovor'] = $statusUgovor;
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
        $this->ModelKorisnik->promeniStatusUgovora($statusUgovora, $idUgovor);

        redirect("ITmenadzer/novcaniUgovori");
    }
    

    public function email() {
        $this->loadView("mail.php");

        // $this->load->library('email');

        $from_email = "im@test.com";
        $to_email = $this->input->post('email');

        $this->load->library('email');
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('Test');
        $this->email->message('Radi');

//        $config = array();
//        $config['protocol'] = 'smtp';
//        $config['smtp_host'] = 'smtp.mailtrap.io';
//        $config['smtp_user'] = 'e3b10a3878459a';
//        $config['smtp_pass'] = '2cfced64cf3a57';
//        $config['smtp_port'] = 2525;
//        $this->email->initialize($config);


        $config['useragent'] = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
        $config['protocol'] = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'smtp.mailtrap.io';
        $config['smtp_user'] = 'e3b10a3878459a';
        $config['smtp_pass'] = '2cfced64cf3a57';
        $config['smtp_port'] = 2525;
        $config['smtp_timeout'] = 30;                       // (in seconds)
        $config['smtp_crypto'] = 'tls';                    // '' or 'tls' or 'ssl'
        $config['smtp_debug'] = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
        $config['debug_output'] = '';                       // PHPMailer's SMTP debug output: 'html', 'echo', 'error_log' or user defined function with parameter $str and $level. NULL or '' means 'echo' on CLI, 'html' otherwise.
        $config['smtp_auto_tls'] = false;                    // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
        $config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
        $config['wordwrap'] = true;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';                   // 'text' or 'html'
        $config['charset'] = null;                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
        $config['validate'] = true;
        $config['priority'] = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
        $config['crlf'] = "\n";                     // "\r\n" or "\n" or "\r"
        $config['newline'] = "\n";                     // "\r\n" or "\n" or "\r"
        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;
        $config['encoding'] = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.
// DKIM Signing
        $config['dkim_domain'] = '';                       // DKIM signing domain name, for exmple 'example.com'.
        $config['dkim_private'] = '';                       // DKIM private key, set as a file path.
        $config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
        $config['dkim_selector'] = '';                       // DKIM selector.
        $config['dkim_passphrase'] = '';                       // DKIM passphrase, used if your key is encrypted.
        $config['dkim_identity'] = '';                       // DKIM Identity, usually the email address used as the source of the email.
        
        
        $this->email->initialize($config);

//       $config['protocol'] = 'sendmail';
//       $config['mailpath'] = '/usr/sbin/sendmail';
//       $config['charset'] = 'iso-8859-1';
//       $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//        $this->email->from('im@test.com', 'Ivan Markovic');
////        
//        $this->email->to('someone@example.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');
//
//        $this->email->subject('naslov');
//        $this->email->message('Postovani, Pratite ETF partnere');

        $this->email->send();
        echo $this->email->print_debugger();
    }

    public function promeniPodatkeDonatorskihUgovora(){
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

        redirect("ITmenadzer/donatorskiUgovori");

    }

}
