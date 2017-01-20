<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Oseba {
	public function login($user) {
		$_SESSION["user"] = $user;
	}

	public function logout($user) {
		session_destroy();
	}

	public function isLoggedIn() {
                return isset($_SESSION["user"]);
	}

	public function getUsername() {
                if (isset($_SESSION["admin"])){
                    return "admin";
                }
		return $_SESSION["user"]["ime"] . " " . $_SESSION["user"]["priimek"];
	}
        
	public function getElektronski() {
		return $_SESSION["user"]["email"];
	}
        
        public function getNaslov(){
            return $_SESSION["user"]["naslov"];
        }
        
        public function getId() {
		return $_SESSION["user"]["id"];
	}
        public function isAdmin(){
            return isset($_SESSION["admin"]);
        }
        

}