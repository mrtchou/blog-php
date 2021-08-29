<?php

abstract class AbstractEntity
{
    public function __construct($donnees = null)
    {
      if($donnees !=null){
          $this->hydrate($donnees);
      }
    }

    public function hydrate(array $donnees)
    {
      foreach ($donnees as $key => $value)
      {
        // On récupère le nom des setters correspondants
        // si la clef est placesTotales son setter est setPlacesTotales
        // il suffit de mettre la 1ere lettre de key en Maj et de le préfixer par set
        // On récupère le nom du setter correspondant à l'attribut.
        $method = 'set'.ucfirst($key);
        // Si le setter correspondant existe.
        if (method_exists($this, $method))
        {
          // On appelle le setter.
          $this->$method($value);
        }
      }
    }
}
