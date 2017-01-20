<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Select.php';
require_once 'HTML/QuickForm2/Element/InputPassword.php';

class AdminForm extends HTML_QuickForm2 {

    public $ime;
    public $priimek;
    public $email;
    public $naslov;
    public $geslo;
    public $geslo2;
    public $gumb;
    
    public $fs;
    public $osebno;
    public $racun;

    public function __construct($idadministrator) {
        parent::__construct($idadministrator);

        $this->ime = new HTML_QuickForm2_Element_InputText('ime');
        $this->ime->setAttribute('size', 15);
        $this->ime->setLabel('Ime:');
        $this->ime->addRule('required', 'Vnesite ime.');
        $this->ime->addRule('regex', 'Pri imenu uporabite le črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->ime->addRule('maxlength', 'Ime naj bo krajše od 255 znakov.', 255);

        $this->priimek = new HTML_QuickForm2_Element_InputText('priimek');
        $this->priimek->setAttribute('size', 15);
        $this->priimek->setLabel('Priimek:');
        $this->priimek->addRule('required', 'Vnesite priimek.');
        $this->priimek->addRule('regex', 'Pri priimku uporabite le črke.', '/^[a-zA-ZščćžŠČĆŽ\- ]+$/');
        $this->priimek->addRule('maxlength', 'Priimek naj bo krajši od 255 znakov.', 255);

        $this->email = new HTML_QuickForm2_Element_InputText('email');
        $this->email->setAttribute('size', 25);
        $this->email->setLabel('E-mail naslov:');
        $this->email->addRule('required', 'Vnesite elektronski naslov.');
        $this->email->addRule('callback', 'Vnesite veljaven elektronski naslov.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_EMAIL])
        );
        $this->naslov = new HTML_QuickForm2_Element_InputText('naslov');
        $this->naslov->setAttribute('size', 15);
        $this->naslov->setLabel('Naslov:');
        $this->naslov->addRule('required', 'Vnesite naslov.');
        $this->naslov->addRule('regex', 'Pri Naslovu uporabite ime ulice in hišno številko.', '/^[a-zA-ZščćžŠČĆŽ0-9\- ]+ [0-9]+$/');
        $this->naslov->addRule('maxlength', 'Naslov naj bo krajši od 255 znakov.', 255);
        
        $this->geslo = new HTML_QuickForm2_Element_InputPassword('geslo');
        $this->geslo->setLabel('Izberite geslo:');
        $this->geslo->setAttribute('size', 15);
        $this->geslo->addRule('required', 'Vnesite geslo.');
        $this->geslo->addRule('minlength', 'Geslo naj vsebuje vsaj 6 znakov.', 6);
        $this->geslo->addRule('regex', 'V geslu uporabite vsaj 1 številko.', '/[0-9]+/');
        $this->geslo->addRule('regex', 'V geslu uporabite vsaj 1 veliko črko.', '/[A-Z]+/');
        $this->geslo->addRule('regex', 'V geslu uporabite vsaj 1 malo črko.', '/[a-z]+/');

        $this->geslo2 = new HTML_QuickForm2_Element_InputPassword('geslo2');
        $this->geslo2->setLabel('Ponovite geslo:');
        $this->geslo2->setAttribute('size', 15);
        $this->geslo2->addRule('required', 'Ponovno vpišite izbrano geslo.');
        $this->geslo2->addRule('eq', 'Gesli nista enaki.', $this->geslo);
        
        $this->gumb = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->gumb->setAttribute('value', 'Registriraj se');
        
        if (Oseba::isLoggedIn()){
            $this->ime->setValue($_SESSION["user"]["ime"]);
            $this->priimek->setValue($_SESSION["user"]["priimek"]);
            $this->email->setValue($_SESSION["user"]["email"]);
            $this->naslov->setValue($_SESSION["user"]["naslov"]);
            $this->gumb->setAttribute('value', 'Spremeni podatke');
        }

        $this->fs = new HTML_QuickForm2_Container_Fieldset();
        $this->fs->setLabel('Registracija novega uporabnika');
        $this->addElement($this->fs);

        $this->osebno = new HTML_QuickForm2_Container_Fieldset();
        $this->osebno->setLabel('Osebni podatki');
        $this->fs->addElement($this->osebno);

        $this->racun = new HTML_QuickForm2_Container_Fieldset();
        $this->racun->setLabel('Podatki o računu');
        $this->fs->addElement($this->racun);

        $this->osebno->addElement($this->ime);
        $this->osebno->addElement($this->priimek);
        $this->racun->addElement($this->email);
        $this->racun->addElement($this->naslov); 
        $this->racun->addElement($this->geslo);
        $this->racun->addElement($this->geslo2);
        $this->fs->addElement($this->gumb);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }

}
