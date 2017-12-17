<?php declare(strict_types=1);

namespace spec\App\Application\Report;

use App\Application\Report\Report;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\UuidInterface;

class ReportSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Report::class);
    }

    function let()
    {
        $this->beConstructedWith(
            "TODO report"
        );
    }

    function it_should_has_guid()
    {
        $this->getId()->shouldReturnAnInstanceOf(UuidInterface::class);
    }

    function it_should_has_name()
    {
        $this->getName()->shouldReturn('TODO report');
    }

    function it_should_has_elements()
    {
        $this->getElements()->shouldReturn([]);
    }
}
