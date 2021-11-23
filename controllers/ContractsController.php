<?php
require_once 'entities/Contract.php';

class ContractsController
{

    protected $contractsRepository;

    public function __construct(ContractsRepository $contractsRepository)
    {
        $this->contractsRepository = $contractsRepository;
    }


    public function showContractsAction(Request $request)
    {
        return new Response($this->render('contracts', ['contractsRepository' => $this->contractsRepository]));
    }

    public function showContractsFormAction(Request $request)
    {
        if ($request->isPost()) {
            $contract = new Contract();

            $contract->number = $request->getPostParameter('number');
            $contract->agent_name = $request->getPostParameter('agent_name');
            $contract->living_complex = $request->getPostParameter('living_complex');
            $contract->award_type = $request->getPostParameter('award_type');
            $contract->award_size = $request->getPostParameter('award_size');
            $contract->sign_date = $request->getPostParameter('sign_date');
            $contract->expiration_date = $request->getPostParameter('expiration_date');


            $this->contractsRepository->addContract($contract);
            return new Response($this->render('contracts', ['contractsRepository' => $this->contractsRepository]));
        }
        return new Response($this->render('add-contract'));
    }

    protected function render($templateName, $vars = [])
    {
        ob_start();
        extract($vars);
        include sprintf('templates/%s.php', $templateName);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function __call($name, $arguments)
    {
        return new Response('Sorry but this action not found',
            '404', 'Not found');
    }

}