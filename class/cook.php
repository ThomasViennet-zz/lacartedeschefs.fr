<?php
class Cook
{
  private $_id;
  private $_identifiant;
  private $_picture;
  private $_total;
  private $_nbrNote;
  private $_email;
  private $_nbrFollower;
  private $_nbrFollowing;
  private $_etoile;
  private $_nbrEtoile;
  private $_coef;
  private $_auth;

  public function __construct($id)
  {
    require 'base.php';

    //Le nbr de personnes qui me suivent
    $req = $bdd->prepare('SELECT COUNT(f.id) nbr_follower
      FROM followers f
      WHERE f.id_following = :id ');
    $req->execute(array('id' => $id)) or die('erreur');
    $resultat = $req->fetch();
    $req->closeCursor();

    if ($resultat['nbr_follower'] <= 1) {
      $follower = $resultat['nbr_follower'].' abonné';
    }else {
      $follower = $resultat['nbr_follower'].' abonnés';
    }

    $this->setNbrFollower($follower);

    //Le nbr de personnes que je suis
    $req = $bdd->prepare('SELECT COUNT(f.id) nbr_following
      FROM followers f
      WHERE f.id_follower = :id ');
    $req->execute(array('id' => $id)) or die('erreur');
    $resultat = $req->fetch();
    $req->closeCursor();

    $this->setNbrFollowing($resultat['nbr_following']);

    $req = $bdd->prepare(
      'SELECT c.profile_picture cook_picture, c.identifiant cook_identifiant, c.email cook_email, c.auth cook_auth,
      SUM(v.note) note_total, COUNT(v.note) nbr_note
      FROM cooks c
      INNER JOIN votes v
      ON c.id = v.id_cook
      WHERE c.id = :id');
    $req->execute(array('id' => $id));
    $resultat = $req->fetch();
    $req->closeCursor();

    $this->setId($id);
    $this->setIdentifiant($resultat['cook_identifiant']);
    $this->setEmail($resultat['cook_email']);
    $this->setPicture($resultat['cook_picture']);
    $this->setTotal($resultat['note_total']);
    $this->setNbrNote($resultat['nbr_note']);
    $this->setAuth($resultat['cook_auth']);

    /*
    Est-ce que le cook est étoilé ?
    */
    $etoileFull = '<img src="images/starFull.svg"/>';
    $etoile = '<img src="images/star.svg"/>';
    $etoiles = $etoile.''.$etoile.''.$etoile;
    $coefficient = 0.01;

    //Combien de customers ont déjà voté
    $req = $bdd->query('SELECT COUNT(DISTINCT id_cook) nbr_cook FROM votes');
    $vote = $req->fetch();
    $req->closeCursor();

    if($vote['nbr_cook'] >= 0) {//nbr_cook avant de créer le classement
      $formuleTop5 = ceil($vote['nbr_cook']*0.1);
      $formuleTop20 = ceil($vote['nbr_cook']*0.3);
      $formuleTop50 = ceil($vote['nbr_cook']*0.5);

      $etoileSession = 0;

      //classement top 50
      $req = $bdd->query(
        'SELECT id
        FROM cooks
        ORDER BY points DESC, id
        LIMIT '.$formuleTop50) or die('erreur');

      //Est-ce que le cook fait partie ?
      while ($resultat = $req->fetch()) {
        if($id == $resultat['id'])
        {
          $etoileSession = 1;
          $coefficient = 0.05;
          $etoiles = $etoileFull.''.$etoile.''.$etoile;
        }
      }

      //classement top 20
      $req = $bdd->query(
        'SELECT id
        FROM cooks
        ORDER BY points DESC, id
        LIMIT '.$formuleTop20) or die('erreur');

      //Est-ce que le cook fait partie ?
      while ($resultat = $req->fetch()) {
        if($id == $resultat['id'])
        {
          $etoileSession = 2;
          $coefficient = 0.08;
          $etoiles = $etoileFull.''.$etoileFull.''.$etoile;
        }
      }

      //classement top 5
      $req = $bdd->query(
        'SELECT id
        FROM cooks
        ORDER BY points DESC, id
        LIMIT '.$formuleTop5) or die('erreur');

      //Est-ce que le cook fait partie ?
      while ($resultat = $req->fetch()) {
        if($id == $resultat['id'])
        {
          $etoileSession = 3;
          $coefficient = 0.1;
          $etoiles = $etoileFull.''.$etoileFull.''.$etoileFull;
        }
      }
    }

    $this->setNbrEtoile($etoileSession);
    $this->setEtoile($etoiles);
    $this->setCoef($coefficient);
  }

  public function getRecipes($idCook)
  {
    require 'base.php';

    $req = $bdd->prepare('SELECT id FROM recipes WHERE id_cook = :id_cook');
    $req->execute(array('id_cook' => $idCook)) or die('erreur');

    $cook = new Cook($idCook);
    require 'class/recipe.php';

    while ($resultat = $req->fetch())
    {
      $recipe = new Recipe($resultat['id']);

      echo '
      <div class="element" style="background-color:rgb(245,245,245);">

        <div style="padding:5px;">
          <a href="?action=cook&cook_id='.$cook->id().'">
          <img src="uploads/avatars/80x80_'.$cook->picture().'" width="30px" class="profilPicture">
          '.$cook->identifiant().'
          </a>
        </div>

        <a href="?action=recipe&id_recipe='.$recipe->id().'">
        <img src="uploads/recipes/400x400_'.$recipe->picture().'" width="100%"/>
        </a>

        <div style="padding: 5px">
          '.$recipe->moyenne().'('.$recipe->nbrNote().')<br>
          '.$recipe->title().'
        </div>

      </div>
      ';
    }
  }

  public function nbrFollowing()
  {
    return $this->_nbrFollowing;
  }

  public function setNbrFollowing($nbrFollowing)
  {
    $this->_nbrFollowing = $nbrFollowing;
  }

  public function auth()
  {
    return $this->_auth;
  }

  public function setAuth($auth)
  {
    $this->_auth = $auth;
  }

  public function nbrEtoile()
  {
    return $this->_nbrEtoile;
  }

  public function setNbrEtoile($nbrEtoile)
  {
    $this->_nbrEtoile = $nbrEtoile;
  }

  public function coef()
  {
    return $this->_coef;
  }

  public function setCoef($coef)
  {
    $this->_coef = $coef;
  }

  public function nbrFollower()
  {
    return $this->_nbrFollower;
  }

  public function setNbrFollower($nbrFollower)
  {
    $this->_nbrFollower = $nbrFollower;
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

  public function etoile()
  {
    return $this->_etoile;
  }

  public function setEtoile($etoile)
  {
    $this->_etoile = $etoile;
  }
}
