<?php


class ControllerTestCase extends TestCase
{
    /**
     * Assert the controller layout has a given
     * named section, and (optionally) that section
     * has given named variables.
     * 
     * @param  string       $section  section name
     * @param  string|array $keys     variable(s) in section
     */
    protected function assertLayoutHas($section, $keys=Null)
    {
        $this->assertPropertyExists($this->layout, $section);
        $this->assertIsView($this->layout->$section);

        if ($keys) {
            $this->assertArrayHasKeys($keys, 
                $this->layout->$section->getData());
        }
    }


    protected function assertPropertyExists($test, $property='content')
    {
        if (!isset($test->$property)) {
            $this->assertTrue(False, "Property '$property' does not exist");
        }
    }

    protected function assertIsView($test)
    {
        $this->assertInstanceOf('Illuminate\View\View', $test);
    }

    protected function assertIsRedirect($test, $url=Null)
    {
        $this->assertInstanceOf('Illuminate\Http\RedirectResponse', $test);

        if ($url) {
            $this->assertEquals($url, $test->getTargetUrl());
        }
    }

    protected function setupLayout($test)
    {
        $this->callProtectedMethod($test, 'setupLayout', array());
    }

    protected function getLayout($test)
    {
        return $this->getProtectedProperty($test, 'layout');
    }

    protected function setupValidator($returnValue, $returnErrs=array())
    {
        Validator::shouldReceive('make')->once()
            ->andReturn(Mockery::mock(array(
                'passes'=>$returnValue, 
                'errors'=>$returnErrs,
            )));
    }

}

