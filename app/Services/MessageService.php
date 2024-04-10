<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;

class MessageService
{
    public function __construct(protected MessageRepository $messageRepository)
    {

    }

    public function getMessagefiels () {
        return $this->messageRepository->setMessage(new Message('Por favor, preencha todos os campos.'), 'error');
    }
    public function passwordsNotSame () {
        return $this->messageRepository->setMessage(new Message('As senhas não são iguais.'), 'error');
    }
    public function validateEmails () {
        return $this->messageRepository->setMessage(new Message('Usuário já cadastrato, tente outro email.'), 'error');
    }
    public function messageLogininvalidUser () {
        return $this->messageRepository->setMessage(new Message('Usuário e/ou senha incorretos.'), 'error');
    }
    public function setWelcomeMessage ($name) {
        return $this->messageRepository->setMessage(new Message("Seja bem-vindo/a, $name!"), 'success');
    }
    public function messageLogoutdUser () {
        return $this->messageRepository->setMessage(new Message('Você fez o logout com sucesso!'), 'success');
    }
    public function messageupdateUser () {
        return $this->messageRepository->setMessage(new Message('Dados do perfil atualizados com sucesso!'), 'success');
    }
    public function messageErrorUpdateUser () {
        return $this->messageRepository->setMessage(new Message('Não foi possível atualizar os dados do perfil.'), 'success');
    }
    public function messageupdatePassword () {
        return $this->messageRepository->setMessage(new Message('Senha atualizada com sucesso!'), 'success');
    }
    public function messageErrorupdatePassword () {
        return $this->messageRepository->setMessage(new Message('Não foi possível atualizar a senha!'), 'success');
    }
    public function messageErrorAddMovie() {
        return $this->messageRepository->setMessage(new Message('Por favor, preencha os campos obrigatórios para adicionar o filme.'), 'error');
    }
    public function messageAddMovie () {
        return $this->messageRepository->setMessage(new Message('Filme adicionado com sucesso!'), 'success');
    }
    public function messageMovieNotFound () {
        return $this->messageRepository->setMessage(new Message('Filme não encontrado'), 'error');
    }
    public function messageExcludeMovie () {
        return $this->messageRepository->setMessage(new Message('Filme excluido com sucesso'), 'success');
    }
    public function messageUpdateMovie () {
        return $this->messageRepository->setMessage(new Message('Dados atualizados com sucesso'), 'success');
    }
    public function messageReviewError () {
        return $this->messageRepository->setMessage(new Message('Você precisa inserir a nota e o comentário!'), 'error');
    }
    public function messageReview () {
        return $this->messageRepository->setMessage(new Message('Crítca adicionada com sucesso!'), 'success');
    }
}
