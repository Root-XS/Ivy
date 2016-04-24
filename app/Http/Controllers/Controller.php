<?php

namespace Ivy\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /** @var Illuminate\View\View $layout The view object for rendering. */
    protected $layout;

    /** @var string $strAction The current controller action. */
    protected $strAction = '';

    /** @var string $strController The current controller. */
    protected $strController = '';

    /** @var string $strViewScript Allows child classes to override the standard view script mapping. */
    protected $strViewScript;

    /**
     * Extends parent::callAction()
     *
     * Trigger misc global setup.
     *
     * Any controller can define a general() method
     * for setup common to all actions.
     *
     * @param string $strMethod
     * @param array $aParameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($strMethod, $aParameters)
    {
        $mResult = null;
        $this->setupLayout($strMethod);

        // Call the action if $this->general() doesn't suggest otherwise
        if (method_exists($this, 'general'))
            $mResult = $this->general();
        if (!$mResult)
            $mResult = parent::callAction($strMethod, $aParameters);

        return isset($mResult) ? $mResult : $this->layout; // must use isset() for case of empty array in AJAX response
    }

    /**
     * Setup the layout used by the controller.
     *
     * @param string $strMethod
     */
    protected function setupLayout($strMethod)
    {
        // Get Controller & Action names
        $strDelimeter = '-';
        $this->strController = str_replace(
            // Laravel snake_case() doesn't recognize \, so remove it
            '\\' . $strDelimeter,
            '.',
            snake_case(
                // Remove fluff from classname
                str_replace(['Ivy\Http\Controllers\\', 'Controller'], '', get_class($this)),
                $strDelimeter
            )
        );
        $this->strAction = strtolower(snake_case(
            substr($strMethod, strlen(\Request::method())),
            '-'
        ));

        // Create default view mapping
        if (\Request::isMethod('get')
            && 0 !== strpos($this->strController, 'auth.')
            && strpos($this->strController, 'api') !== 0
        ) {
            if (!$this->strViewScript)
                $this->strViewScript = $this->strController . '.' . $this->strAction;

            $this->layout = \View::make($this->strViewScript, [
                'bGuestHome' => ('index' === $this->strController && 'index' == $this->strAction),
                'strController' => $this->strController,
                'strAction' => $this->strAction,
            ]);
        }
    }

}
