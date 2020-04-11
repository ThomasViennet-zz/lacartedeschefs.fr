<?php
class Cook
{
  private $_id;
  private $_identifiant;
  private $_picture;
  private $_moyenne;
  private $_total;
  private $_nbrNote;
  private $_email;

  public function __construct($id)
  {
    require 'base.php';

    $reponse = $bdd->prepare(
      'SELECT c.profile_picture cook_picture, c.identifiant cook_identifiant, c.email cook_email,
      AVG(v.note) note_moyenne, SUM(v.note) note_total, COUNT(v.note) nbr_note
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
    $this->setPicture($resultat['cook_picture']);

    if ($resultat['note_total'] == 0) {
      $nbr_point = 'Pas encore de point';
      $this->setTotal($nbr_point);
    }elseif ($resultat['note_total'] == 1) {
      $nbr_point = '1 point';
      $this->setTotal($nbr_point);
    }else {
      $nbr_point = $resultat['note_total'].' points';
      $this->setTotal($nbr_point);
    }

    if ($resultat['nbr_note'] == 0) {
      $nbr_point = 'Pas encore de note';
      $this->setNbrNote($nbr_point);
    }elseif ($resultat['nbr_note'] == 1) {
      $nbr_point = '1 note';
      $this->setNbrNote($nbr_point);
    }else {
      $nbr_point = $resultat['nbr_note'].' notes';
      $this->setNbrNote($nbr_point);
    }

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
        $etoileFull = '<img src="images/starFull.svg"/>';
        $etoile = '<img src="images/star.svg"/>';
        $note = $etoile.''.$etoile.''.$etoile;
      }else {
        if($resultat2['recipe_moyenne'] < 2)
        {
          $etoileFull = '<img src="images/starFull.svg"/>';
          $etoile = '<img src="images/star.svg"/>';
          $note = $etoileFull.''.$etoile.''.$etoile;
        }

        if($resultat2['recipe_moyenne'] >= 2)
        {
          $etoileFull = '<img src="images/starFull.svg"/>';
          $etoile = '<img src="images/star.svg"/>';
          $note = $etoileFull.''.$etoileFull.''.$etoile;
        }

        if($resultat2['recipe_moyenne'] >= 2.5)
        {
          $etoileFull = '<img src="images/starFull.svg"/>';
          $etoile = '<img src="images/star.svg"/>';
          $note = $etoileFull.''.$etoileFull.''.$etoileFull;
        }
      }

      $reponse3 = $bdd->query('SELECT identifiant, profile_picture FROM cooks WHERE id = '.$idCook);
      $resultat3 = $reponse3->fetch();
      $reponse3->closeCursor();

      echo '
      <div class="element" style="background-color:rgb(245,245,245);">

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

  public function nbrNote()
  {
    return $this->_nbrNote;
  }

  public function setNbrNote($nbrNote)
  {
    $this->_nbrNote = $nbrNote;
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
