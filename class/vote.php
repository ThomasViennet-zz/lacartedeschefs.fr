<?php
class Vote
{
  private $_id;
  private $_idRecipe;
  private $_idCook;
  private $_idCustomer;
  private $_note;

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
    
    $req = $bdd->prepare('SELECT id_recipe, id_cook, id_customer, note FROM votes WHERE id = :id');
    $req->execute(array('id' => $id));
    $resultat = $req->fetch();

    $req->closeCursor();

    $this->setID($id);
  }

  public function id()
  {
    return $this->_id;
  }

  public function setId($id)
  {
    $this->_id = $id;
  }
}
