<?php
 $I = new WebGuy($scenario);
 $I->wantTo('Verificar que hay mensaje de error cuando no se carga imagen');
 $I->amOnPage('/agregarproducto');
 $I->click('Publicar');
 $I->seeInCurrentUrl('/agregarproducto');
 $I->see('imagen field is required');
