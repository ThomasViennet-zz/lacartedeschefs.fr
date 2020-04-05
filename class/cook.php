<?php
class Cook
{
  private $_id;
  private $_identifiant;
  private $_picture;
  private $_moyenne;
  private $_email;

  public function __construct($id)
  {
    require 'base.php';

    $reponse = $bdd->prepare(
      'SELECT c.profile_picture cook_picture, c.identifiant cook_identifiant, c.email cook_email,
      AVG(v.note) note_moyenne, SUM(v.note) note_total
      FROM cooks c
      INNER JOIN votes v
      ON c.id = v.id_cook
      WHERE c.id = :id');
    $reponse->execute(array('id' => $id));
    $resultat = $reponse->fetch();
    $reponse->closeCursor();

    $reponse->closeCursor();
    $this->setId($id);
    $this->setIdentifiant($resultat['cook_identifiant']);
    $this->setPicture($resultat['cook_picture']);
    $this->setEmail($resultat['cook_email']);

    if(empty($resultat['note_moyenne']))
    {
      $etoile = '<img src="images/starFull.svg"/>';
      $note = 'Pas encore de note';
      $this->setMoyenne($note);
    }else {
      if($resultat['note_moyenne'] < 2)
      {
        $etoile = '<img src="images/starFull.svg"/>';
        $note = $etoile;
        $this->setMoyenne($note);
      }

      if($resultat['note_moyenne'] >= 2)
      {
        $etoile = '<img src="images/starFull.svg"/>';
        $note = $etoile.''.$etoile;
        $this->setMoyenne($note);
      }

      if($resultat['note_moyenne'] >= 3)
      {
        $etoile = '<img src="images/starFull.svg"/>';
        $note = $etoile.''.$etoile.''.$etoile;
        $this->setMoyenne($note);
      }
    }
  }

  public function getRecipes($idCook)
  {
    require 'base.php';

    $reponse = $bdd->query('SELECT id, title, recipe_picture, description FROM recipes WHERE id_cook = '.$idCook);

    while ($donnees = $reponse->fetch())
    {
      $reponse2 = $bdd->query(
        'SELECT AVG(note) recipe_moyenne
        FROM votes
        WHERE id_recipe = '.$donnees['id']);
      $resultat2 = $reponse2->fetch();
      $reponse2->closeCursor();

      if(empty($resultat2['recipe_moyenne']))
      {
        $etoile = '<img src="images/starFull.svg"/>';
        $note = 'Pas encore de note';
      }else {
        if($resultat2['recipe_moyenne'] < 2)
        {
          $etoile = '<img src="images/starFull.svg"/>';
          $note = $etoile;
        }

        if($resultat2['recipe_moyenne'] >= 2)
        {
          $etoile = '<img src="images/starFull.svg"/>';
          $note = $etoile.''.$etoile;
        }

        if($resultat2['recipe_moyenne'] >= 3)
        {
          $etoile = '<img src="images/starFull.svg"/>';
          $note = $etoile.''.$etoile.''.$etoile;
        }
      }

      echo '
      <div class="element">
        <a href="?action=recipe&id_recipe='.$donnees['id'].'"><img src="uploads/recipes/300x300_'.$donnees['recipe_picture'].'"/></a><br>
        '.$note.'<br>
        '.$donnees['title'].'<br>
        '.$donnees['description'].'
      </div>
      '

      ;
    }

    $reponse->closeCursor();
  }

  public function email()
  {
    return $this->_email;
  }

  public function setEmail($email)
  {
    $this->_email = $email;
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
