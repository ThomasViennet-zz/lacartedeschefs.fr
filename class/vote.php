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
    require 'base.php';

    $reponse = $bdd->prepare('SELECT id_recipe, id_cook, id_customer, note FROM votes WHERE id = :id');
    $reponse->execute(array('id' => $id));
    $resultat = $reponse->fetch();
    $reponse->closeCursor();

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
