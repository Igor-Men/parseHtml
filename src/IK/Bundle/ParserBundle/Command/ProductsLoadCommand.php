<?php

namespace IK\Bundle\ParserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;



class ProductsLoadCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ik:load:products')
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $timeStart = time();
        $count = 0;
        $try = 1;

        $array = [];
        for ($i=0; $i<1000000; $i++) {
            $timeStartLap = time();

            $xmlResponseStart = time();
            $jsonString = $this->getContainer()->get('ik_bundle_XmlParserService')->getJsonProducts($this->getContainer()->getParameter('api_key'), $i);
            $xmlResponseEnd = time();

            $resultArr = json_decode($jsonString, true);


            if ($try > 20) {
                $i = 999998;
            }
            if (!$resultArr) {
                $try++;
                continue;
            }

            $writeStart = time();
            $currentCount = $this->getContainer()->get('ik_bundle_XmlParserService')->writeProducts($resultArr);
            $writeEnd = time();
            //$currentCount = count($resultArr['group']);
            if (!$currentCount) {
                $try++;
            }

            $count = $count + $currentCount;

            $timeStartEndLap = time();
            $speed = number_format($count/((((int)$timeStartEndLap+1) - (int)$timeStartLap)/60), 2);
            echo("\ntotal_count-".$count." current_count-".$currentCount." page-".$i ." try-".$try." timeLap ".$timeStartLap.'-'.$timeStartEndLap.'('.($timeStartEndLap-$timeStartLap).')'.'('.((((int)$timeStartEndLap+1) - (int)$timeStart)/60).'min) speed-'.$speed.'xmlResponse-' . $xmlResponseStart. '-' . $xmlResponseEnd.'('.($xmlResponseEnd-$xmlResponseStart).')'.' write-' . $writeEnd. '-' . $writeStart.'('.($writeEnd-$writeStart).')');
        }
        $timeEnd = time();

        echo("final count ".$count ." Start time ".$timeStart. "END time " . $timeEnd);
        exit('->>>>>>>>>>>>>>>>>>>>>>.end' );
    }
}