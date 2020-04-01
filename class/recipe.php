<?php
class Recipe
{
  private $_id;
  private $_idCook;
  private $_picture;
  private $_title;
  private $_description;
  private $_ingredients;
  private $_steps;

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
      'SELECT r.title recipe_title, r.recipe_picture recipe_picture, r.description recipe_description, r.id_cook recipe_cook, r.steps recipe_steps, r.ingredients recipe_ingredients,
      AVG(v.note) note_moyenne, SUM(v.note) note_total
      FROM recipes r
      INNER JOIN votes v
      ON r.id = v.id_recipe
      WHERE r.id = :id');

    $req->execute(array('id' => $id));
    $resultat = $req->fetch();
    $req->closeCursor();

    $this->setId($id);
    $this->setTitle($resultat['recipe_title']);
    $this->setPicture($resultat['recipe_picture']);
    $this->setDescription($resultat['recipe_description']);
    $this->setIdCook($resultat['recipe_cook']);
    $this->setIngredients($resultat['recipe_ingredients']);
    $this->setSteps($resultat['recipe_steps']);
    $this->setMoyenne($resultat['note_moyenne']);
    $this->setTotal($resultat['note_total']);

    // $req = $bdd->prepare('SELECT title, recipe_picture, description, id_cook, steps, ingredients FROM recipes WHERE id = :id');
    // $req->execute(array('id' => $id));
    // $resultat = $req->fetch();
    // $req->closeCursor();
    //
    // $this->setId($id);
    // $this->setTitle($resultat['title']);
    // $this->setPicture($resultat['recipe_picture']);
    // $this->setDescription($resultat['description']);
    // $this->setIdCook($resultat['id_cook']);
    // $this->setIngredients($resultat['ingredients']);
    // $this->setSteps($resultat['steps']);
  }

  public function total()
  {
    return $this->_total;
  }

  public function setTotal($total)
  {
    $this->_total = $total;
  }

  public function moyenne()
  {
    return $this->_moyenne;
  }

  public function setMoyenne($moyenne)
  {
    $this->_moyenne = $moyenne;
  }

  public function id()
  {
    return $this->_id;
  }

  public function setId($id)
  {
    $this->_id = $id;
  }

  public function picture()
  {
    return $this->_picture;
  }

  public function setPicture($picture)
  {
    $this->_picture = $picture;
  }

  public function title()
  {
    return $this->_title;
  }

  public function setTitle($title)
  {
    $this->_title = $title;
  }

  public function description()
  {
    return $this->_description;
  }

  public function setDescription($description)
  {
    $this->_description = $description;
  }

  public function idCook()
  {
    return $this->_idCook;
  }

  public function setIdCook($idCook)
  {
    $this->_idCook = $idCook;
  }

  public function ingredients()
  {
    return $this->_ingredients;
  }

  public function setIngredients($ingredients)
  {
    $this->_ingredients = $ingredients;
  }

  public function steps()
  {
    return $this->_steps;
  }

  public function setSteps($steps)
  {
    $this->_steps = $steps;
  }
}
