O que normalmente entra num README

Título e descrição curta.

Badges (build, php version, license) — opcional.

Screenshot ou GIF rápido (opcional).

Requisitos (PHP, Composer, MySQL, etc.).
# MyPdv

Sistema de gestão de vendas (PDV) simples em PHP — micro-framework próprio com Router, views em `src/Views` e assets em `public/`.

> Pequeno projeto para controle de vendas, cadastro de produtos e testes de rota/templating.

---

## Demo
_Troque por uma imagem ou GIF do sistema_
![Login MyPdv](./public/img/screenshot-login.png)

---

## Requisitos
- PHP 8.0+  
- Composer (opcional, se usar autoload)  
- MySQL / MariaDB (ou ajuste conforme seu banco)
- XAMPP (opcional) ou usar servidor embutido `php -S`

---

## Instalação rápida

```bash
# clonar repositório
git clone https://seu-repositorio.git mypdv
cd mypdv

# (opcional) instalar dependências via composer
composer install

# configurar variáveis (se usar)
cp .env.example .env
# editar .env com DB, BASE_URL, etc.


Instalação (clonar, dependências, configuração .env).

Como rodar (servidor embutido, XAMPP, comandos).
php -S localhost:5100 -t public
# depois abra http://localhost:5100

Estrutura de pastas resumida.
mypdv/
├─ public/              # Document root usado pelo servidor
│  ├─ index.php
│  ├─ lib/              # css, js, imagens
│  └─ img/
├─ src/
│  ├─ Views/
│  │  ├─ shared/
│  │  │  └─ header.php
│  │  └─ home/
│  │     └─ index.php
│  ├─ Controllers/
│  └─ core/
│     └─ Router.php
├─ routes/
│  └─ urls.php
├─ vendor/
└─ README.md


Uso (endpoints, rotas importantes, exemplos).

Testes (se houver).

Deploy (breve).

Contribuição / PRs.

Licença e contato.


bibliotecas utilizadas do composer na packagist

composer require dompdf/dompdf 
e
composer require phpoffice/phpspreadsheet mo pho 8.1  ou superior
composer require phpoffice/phpspreadsheet:"^1.29" para o php 8.0 