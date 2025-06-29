<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 📘 Descrição

O E-Burguers foi meu primeiro grande projeto onde fiz um clone das funcionalidades de um sistema de delivery que opera na cidade onde eu residia.

## 🚀 Tecnologias Utilizadas no projeto

Front-end:
- HTML
- CSS
- JavaScript
- Bootstrap
- Jquery
- LavaCharts
- SweetAlert2

Back-end:
- PHP
- Laravel
- MySql
- Ajax

## ✨ Principais Funcionalidades

- Autenticação de usuários
- Validação de formulários
- Busca em tempo real de entregas via Id ou nome do cliente
- Gerenciamento de entregas
- Dashboard com comparativo mensal de entregas
- Filtragem de entregas por mês
- Informações de unidades com mais entregas
- Controle de permissões (ACL)

Gerenciamento total (CRUD) de:

- Entregas
- Unidades
- Usuários

## 👥 Perfis de Acesso
Administrador: Acesso total ao sistema, com gerenciamento de usuários, unidades e entregas.

Operador: Gerenciamento total de entregas.
## 🌐 O projeto está online!

Acesse em: (https://e-locker.online)

## 🛠️ Como rodar o projeto

1. Tenha em sua máquina um ambiente que faça a emulação de um servidor, como Xampp ou Docker instalado e parametrizado.
2. Clone o repositório:
```bash
git clone https://github.com/gabrieltec97/E-Locker.git
```
3. Copie o arquivo .env.example para .env
4. Instale as dependências com o Composer:
```bash
composer install
```
5. Gere a chave de API do Laravel.
```bash
php (ou sail) artisan key:generate
```
6. Parametrize crie seu banco de dados e preenchendo com as variáveis de nome do banco, usuário, senha e porta no arquivo .env.
7. Rode as migrations e seeders necessárias para dar a configuração inicial para o sistema executar corretamente.
```bash
php (ou sail) artisan migrate --seed
```
8. Inicie o servidor.
```bash
php (ou sail) artisan serve
```
9. Pronto! Agora é só acessar http://localhost:8000
