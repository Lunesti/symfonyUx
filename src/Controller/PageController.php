<?php


namespace App\Controller;

use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{

    /**
     * index
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('page/index.html.twig');
    }

    /**
     * chart
     * @Route("/chart", name="chart")
     * @param  mixed $chartBuilder
     * @return Response
     */
    public function chart(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $camembert = $chartBuilder->createChart(Chart::TYPE_PIE);
        $camembert->setData([
            'labels' => ['Red', 'Blue', 'Yellow'],
            'datasets' => [
                [
                    'backgroundColor' => ["#FF0000", "#FFFF00", "#0000FF"],
                    'data' => [10, 20, 70]
                ],
            ],
        ]);

        return new Response($this->render('page/chart.html.twig', [
            'chart' => $chart,
            'camembert' => $camembert
        ]));
    }
}
