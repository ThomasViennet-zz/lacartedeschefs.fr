<?php
class Recipe
{
  private $_id;
  private $_idCook;
  private $_picture;
  private $_title;
  private $_ingredients;
  private $_steps;
  private $_serve;

  public function __construct($id)
  {
    require 'base.php';

    $reponse = $bdd->prepare(
      'SELECT r.title recipe_title, r.recipe_picture recipe_picture, r.id_cook recipe_cook, r.steps recipe_steps, r.ingredients recipe_ingredients, r.serve recipe_serve,
      AVG(v.note) note_moyenne, SUM(v.note) note_total
      FROM recipes r
      INNER JOIN votes v
      ON r.id = v.id_recipe
      WHERE r.id = :id');
    $reponse->execute(array('id' => $id));
    $resultat = $reponse->fetch();
    $reponse->closeCursor();

    $this->setId($id);
    $this->setTitle($resultat['recipe_title']);
    $this->setPicture($resultat['recipe_picture']);
    $this->setIdCook($resultat['recipe_cook']);
    $this->setIngredients($resultat['recipe_ingredients']);
    $this->setSteps($resultat['recipe_steps']);
    $this->setTotal($resultat['note_total']);
    $this->setServe($resultat['recipe_serve']);

    if(empty($resultat['note_moyenne']))
    {
      $etoileFull = '<img src="images/starFull.svg"/>';
      $etoile = '<img src="images/star.svg"/>';
      $note = $etoile.''.$etoile.''.$etoile;
      $this->setMoyenne($note);
    }else {
      if($resultat['note_moyenne'] < 2)
      {
        $etoileFull = '<img src="images/starFull.svg"/>';
        $etoile = '<img src="images/star.svg"/>';
        $note = $etoileFull.''.$etoile.''.$etoile;
        $this->setMoyenne($note);
      }

      if($resultat['note_moyenne'] >= 2)
      {
        $etoileFull = '<img src="images/starFull.svg"/>';
        $etoile = '<img src="images/star.svg"/>';
        $note = $etoileFull.''.$etoileFull.''.$etoile;
        $this->setMoyenne($note);
      }

      if($resultat['note_moyenne'] >= 2.5)
      {
        $etoileFull = '<img src="images/starFull.svg"/>';
        $etoile = '<img src="images/star.svg"/>';
        $note = $etoileFull.''.$etoileFull.''.$etoileFull;
        $this->setMoyenne($note);
      }
    }
  }

  public function serve()
  {
    return Nl2br(htmlspecialchars($this->_serve));
  }

  public function setServe($serve)
  {
    $this->_serve = $serve;
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
    return htmlspecialchars($this->_picture);
  }

  public function setPicture($picture)
  {
    $this->_picture = $picture;
  }

  public function title()
  {
    return htmlspecialchars($this->_title);
  }

  public function setTitle($title)
  {
    $this->_title = $title;
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
    return Nl2br(htmlspecialchars($this->_ingredients));
  }

  public function setIngredients($ingredients)
  {
    $this->_ingredients = $ingredients;
  }

  public function steps()
  {
    return Nl2br(htmlspecialchars($this->_steps));
  }

  public function setSteps($steps)
  {
    $this->_steps = $steps;
  }
}
