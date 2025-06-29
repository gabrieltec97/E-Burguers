<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 📘 Descrição

O E-Burguers foi meu primeiro grande projeto desenvolvido em 2020/21 onde fiz um clone das funcionalidades de um sistema de delivery que opera na cidade onde eu residia. Ainda estava começando minha carreira de desenvolvedor fullstack e então decidi me desafiar a fazer este projeto para testar minha capacidade lógica e de resolução de problemas.

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

- Validação de formulários
- Dashboard com comparativo de vendas ao longo dos meses
- Filtragem de vendas por mês
- Informações de itens mais vendidos
- Busca em tempo real de pedidos via Id ou nome do cliente
- Gerenciamento de pedidos em tempo real
- Controle de permissões (ACL)
- Comparativo de venda de hoje com as vendas de ontem
- Escolha de quais adicionais podem ser postos em quais produtos
- Aplicação de cupons
- Ativação/Desativação do delivery
- Escolha de motoboy para realizar cada entrega
- Escolha de pedido simples ou combo

Gerenciamento total (CRUD) de:

- Entregas
- Bairros
- Usuários
- Itens do cardápio

## 👥 Perfis de Acesso
Administrador: Acesso total ao sistema, com gerenciamento de usuários, unidades e entregas.

Operador: Gerenciamento total de entregas.

Cozinheiro: Acesso aos pedidos e alteração do status de preparo.

Motoboy: Acesso aos dados do pedido e alteração do status para pedido entregue.

## 🛠️ Como rodar o projeto

1. Tenha em sua máquina um ambiente que faça a emulação de um servidor, como Xampp ou Docker instalado e parametrizado.
2. Clone o repositório:
```bash
git clone https://github.com/gabrieltec97/E-burguers.git
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
