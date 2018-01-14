<?php declare(strict_types=1);

namespace spec\App\Application\Report;

use App\Application\Report\Criteria;
use PhpSpec\ObjectBehavior;

class CriteriaSpec extends ObjectBehavior
{
    function let()
    {
        //@TODO: refactor
//        $this->beConstructedThrough('unfinished');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Criteria::class);
    }
//
//    function it_should_be_comparable()
//    {
//        $criteria = Criteria::unfinished();
//
//        $this->equals($criteria)->shouldReturn(true);
//    }
//
//    function it_should_be_string_castable()
//    {
//        $this->__toString()->shouldReturn('UNFINISHED');
//    }
//
//    function it_should_has_unfinished_static_constructor()
//    {
//        $this->shouldReturnAnInstanceOf(Criteria::class);
//    }
//
//    function it_should_has_done_static_constructor()
//    {
//        $this->beConstructedThrough('done');
//        $criteria = Criteria::done();
//        $this->equals($criteria)->shouldReturn(true);
//    }
//
//    function it_should_has_inprogress_static_constructor()
//    {
//        $this->beConstructedThrough('inprogress');
//        $criteria = Criteria::inprogress();
//        $this->equals($criteria)->shouldReturn(true);
//    }
//
//    function it_should_has_efficiency_static_constructor()
//    {
//        $this->beConstructedThrough('efficiency');
//        $criteria = Criteria::efficiency();
//        $this->equals($criteria)->shouldReturn(true);
//    }
}
