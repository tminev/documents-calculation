<?php

namespace Helper;

use Codeception\Module;
use Codeception\Step;
use FunctionalTester;

/**
 * Class Functional
 *
 * all public methods declared in this helper class will be available in $I
 */
class Functional extends Module
{
    public function _beforeStep(Step $step)
    {
        $this->getModule('REST')->haveHttpHeader('Origin', 'fake');
    }

    /**
     * Generate jwt token and set as bearer authorization to header
     *
     * @param FunctionalTester $I
     * @param bool $hasRequiredRoles
     */
    public function needBearerAuthentication(
        FunctionalTester $I,
        bool $hasRequiredRoles = true
    ) {
        $config = $this->getModule('ZendExpressive')->container->get('config');
        $jwts = $config['test_JWTs'][$hasRequiredRoles ? 'with_roles' : 'without_roles'];

        $I->amBearerAuthenticated($jwts);
    }
}
