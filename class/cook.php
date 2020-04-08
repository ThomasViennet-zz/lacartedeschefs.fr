<?php
class Cook
{
  private $_id;
  private $_identifiant;
  private $_picture;
  private $_moyenne;
  private $_total;
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

    $this->setId($id);
    $this->setIdentifiant($resultat['cook_identifiant']);
    $this->setEmail($resultat['cook_email']);
    $this->setTotal($resultat['note_total']);
    $this->setPicture($resultat['cook_picture']);

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

      if($resultat['note_moyenne'] >= 2.5)
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

    $reponse = $bdd->query('SELECT id, title, recipe_picture FROM recipes WHERE id_cook = '.$idCook);

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

      $reponse3 = $bdd->query('SELECT identifiant, profile_picture FROM cooks WHERE id = '.$idCook);
      $resultat3 = $reponse3->fetch();
      $reponse3->closeCursor();

      echo '
      <div class="element" style="background-color:rgb(245,245,245);margin: 5px;">

        <div style="padding:5px;">
          <a href="?action=cook&cook_id='.$idCook.'">
          <img src="uploads/avatars/80x80_'.$resultat3['profile_picture'].'" width="30px" class="profilPicture">
          '.$resultat3['identifiant'].'
          </a>
        </div>

        <a href="?action=recipe&id_recipe='.$donnees['id'].'">
        <img src="uploads/recipes/400x400_'.htmlspecialchars($donnees['recipe_picture']).'" width="100%"/></a>

        <div style="padding: 5px">
          '.$note.'<br>
          '.htmlspecialchars($donnees['title']).'
        </div>

      </div>
      ';
    }

    $reponse->closeCursor();
  }

  public function total()
  {
    return htmlspecialchars($this->_total);
  }

  public function setTotal($total)
  {
    $this->_total = $total;
  }

  public function email()
  {
    return htmlspecialchars($this->_email);
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
    return htmlspecialchars($this->_identifiant);
  }

  public function setIdentifiant($identifiant)
  {
    $this->_identifiant = $identifiant;
  }

  public function picture()
  {
    return htmlspecialchars($this->_picture);
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
