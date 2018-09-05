<?php

namespace App\Controller;

use Jenssegers\Blade\Blade;

abstract class Controller {

  /**
   * @var Blade
   */
  private $view;

  /**
   * @return Blade|null
   */
  protected function view() {
    if ($this->view === null) {
      $this->loadView();
    }

    return $this->view;
  }

  private function loadView()
  {
    $this->view = new Blade(VIEWS, CACHE_VIEWS);
  }

}