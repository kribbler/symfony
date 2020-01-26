<?php
declare(strict_types=1);

namespace App\Engine\FirstBundle\Controller;

use App\Engine\FirstBundle\Service\NumberGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    /** @var NumberGenerator */
    private $numberGenerator;

    public function __construct(NumberGenerator $numberGenerator)
    {
        $this->numberGenerator = $numberGenerator;
    }
    /**
     * @Route("/lucky-number")
     */
    public function number()
    {
        $number = $this->numberGenerator->getGeneratedNumber();

        return $this->render('lucky/number.html.twig', [
            'number_binary' => decbin($number),
            'number_hex' => dechex($number),
            'number' => $number,
            'the_name' => '21'
        ]);
    }
}