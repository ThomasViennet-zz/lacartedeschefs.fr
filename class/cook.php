<?php
class Cook
{
  private $_id;
  private $_identifiant;
  private $_picture;
  private $_moyenne;

  public function __construct($id)
  {
    try
    {
      require 'secret.php';;
      $bdd = new PDO('mysql:host=localhost;dbname='. $dbName .';charset=utf8', '' . $dbLogin . '', '' . $dbPassword . '');
    }
      catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    $req = $bdd->prepare(
      'SELECT c.profile_picture cook_picture, c.identifiant cook_identifiant, AVG(v.note) note_moyenne, SUM(v.note) note_total
      FROM cooks c
      INNER JOIN votes v
      ON c.id = v.id_cook
      WHERE c.id = :id');

    $req->execute(array('id' => $id));
    $resultat = $req->fetch();
    $req->closeCursor();

    $this->setId($id);
    $this->setIdentifiant($resultat['cook_identifiant']);
    $this->setPicture($resultat['cook_picture']);
    $this->setMoyenne($resultat['note_moyenne']);
  }
  public function id()
  {
    return $this->_id;
  }

  public function setId($id)
  {
    $this->_id = $id;
  }

  public function identifiant()
  {
    return $this->_identifiant;
  }

  public function setIdentifiant($identifiant)
  {
    $this->_identifiant = $identifiant;
  }

  public function picture()
  {
    return $this->_picture;
  }

  public function setPicture($picture)
  {
    $this->_picture = $picture;
  }

  public function moyenne()
  {
    return $this->_moyenne;
  }

  public function setMoyenne($moyenne)
  {
    $this->_moyenne = $moyenne;
  }
}
