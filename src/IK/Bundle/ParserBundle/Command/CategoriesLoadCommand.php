<?php

namespace IK\Bundle\ParserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;



class CategoriesLoadCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ik:load:categories')
            ->setDescription('load categories')
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

            $xmlString = $this->getContainer()->get('ik_bundle_XmlParserService')->getXmlCategoires($this->getContainer()->getParameter('api_key'));
            $resultArr = $this->getContainer()->get('ik_bundle_XmlParserService')->processConvert($xmlString);
            $result = $this->getContainer()->get('ik_bundle_XmlParserService')->writeCategoies($resultArr, true);
            var_dump("-------------->>>> done");
            var_dump($result);
    }
}