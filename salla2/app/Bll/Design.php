<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of Design
 *
 * @author fz
 */
class Design {

    private $color, $font;

    //put your code here
    public function setColor($c) {
     
        $this->color = $c;
    }

    public function setFont($fontt) {
        $this->font = $fontt;
    }

    public function render() {
        $css = "";
        if ($this->color != "") {
            $color = $this->color;

            $css = "body,a
                {
                color:{$color} !important;
               
                }
                .single-full-product .title a
                {
                 color:{$color} ;
                }
                .single-full-product .price
                {
                 color:{$color} ;
                }
                .section-title
                {
                    color:{$color} !important;
                }
                .droopmenu > li > a,
                .droopmenu > li > span
                {
                     color:{$color} !important;
                }";
        }
        if ($this->font != "") {
            $css .= "@font-face {
                    font-family: sallFont;
                    src: url(../../../../fonts/{$this->font});
                  }
                  a {

                      font-family: sallFont !important;

                  }";
        }

        return $css;
    }

}
