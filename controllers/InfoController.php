<?php

require_once APP_ROOT . '/models/Faq.php';
require_once APP_ROOT . '/models/EmergencyContact.php';

class InfoController extends Controller
{
    private $faq;
    private $contact;

    public function __construct()
    {
        $this->faq = new Faq();
        $this->contact = new EmergencyContact();
    }

    public function faq()
    {
        $faqs = $this->faq->getAll();
        $contacts = $this->contact->getAll();

        $this->view('info/faq', [
            'page_title' => 'FAQ & Emergency Contacts',
            'faqs' => $faqs,
            'contacts' => $contacts
        ]);
    }

    public function manage()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? '';

            if ($type === 'contact_add') {
                $this->contact->create([
                    'name' => trim($_POST['name']),
                    'phone' => trim($_POST['phone']),
                    'type' => trim($_POST['ctype']),
                    'district' => trim($_POST['district'] ?? '')
                ]);
            }

            if ($type === 'contact_update') {
                $this->contact->update((int)$_POST['id'], [
                    'name' => trim($_POST['name']),
                    'phone' => trim($_POST['phone']),
                    'type' => trim($_POST['ctype']),
                    'district' => trim($_POST['district'])
                ]);
            }

            if ($type === 'contact_delete') {
                $this->contact->delete((int)$_POST['id']);
            }

            if ($type === 'faq_add') {
                $this->faq->create([
                    'question' => trim($_POST['question']),
                    'answer' => trim($_POST['answer']),
                ]);
            }

            if ($type === 'faq_update') {
                $this->faq->update((int)$_POST['id'], [
                    'question' => trim($_POST['question']),
                    'answer' => trim($_POST['answer']),
                ]);
            }

            if ($type === 'faq_delete') {
                $this->faq->delete((int)$_POST['id']);
            }

            $this->redirect(BASE_URL . '/index.php?controller=info&action=manage');
        }

        $faqs = $this->faq->getAll();
        $contacts = $this->contact->getAll();

        $this->view('info/manage', [
            'page_title' => 'Manage FAQ & Contacts',
            'faqs' => $faqs,
            'contacts' => $contacts
        ]);
    }
}
