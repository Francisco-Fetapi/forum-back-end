# Forum - back-end
<p align="center">
<a href="https://github.com/Francisco-Fetapi/forum-back-end/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/Francisco-Fetapi/forum-back-end?style=plastic"></a>
<a href="https://github.com/Francisco-Fetapi/forum-back-end"><img alt="GitHub license" src="https://img.shields.io/badge/Exercise-For%20trainning-orange"></a>
<a href="https://github.com/Francisco-Fetapi/forum-back-end/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/Francisco-Fetapi/forum-back-end?style=plastic"></a>
<a href="https://github.com/Francisco-Fetapi/forum-back-end/network"><img alt="GitHub forks" src="https://img.shields.io/github/forks/Francisco-Fetapi/forum-back-end?style=plastic"></a>
<a href="https://github.com/Francisco-Fetapi/forum-back-end"><img alt="GitHub license" src="https://img.shields.io/github/license/Francisco-Fetapi/forum-back-end?style=plastic"></a>
</p>


Depois de aprender o `React`, bem no começo de 2021, tive a ideia de criar um projeto juntamente com `PHP` já que quando entrei no mundo das **SPA's** (_Single Page Application_) eu não tinha ideia de como ia integrar o _front-end_ com _back-end_, naquela época eu sempre criava **sistemas monolíticos**, mas depois desse projeto criei a minha própria arquitetura para construção de API's (uma arquitetura suja, mas que na época era tudo de bom😅) e entendi completamente a sacada de **font-end e back-end desaclopados**.
<br /> <br />
Veja o [Front-End do projeto](https://github.com/Francisco-Fetapi/forum-front-end) para mais informações.

# Pré-requisitos para rodar o sistema localmente
Por ser um projeto de estudo não me preocupei em hospedá-lo, mas caso queiras ver o projeto rodando, eis abaixo alguns elementos que precisas ter instalado em sua máquina.

1. Servidor APACHE e MySQL (para instalar podes usar o XAMPP ou aplicativos similares)
2. Algum Navegador (Óbvio😅)

# Passos para rodar o projeto localmente

Com essas ferramentas instaladas o próximo passo é clonar o repositório:
```
git clone https://github.com/Francisco-Fetapi/forum-back-end.git
```

Com o repositório clonado basta apenas importar o banco de dados com suas respetivas tabelas no seu _gestor de banco de dados_, no exemplo a seguir estarei usando o **PHPMyAdmin**

![importando_bd](https://user-images.githubusercontent.com/74926014/175775785-c8792c9a-6d77-425d-b222-292519af9954.PNG)

Ao acessar o painel para importar um __banco de dados__ deve-se escolher o arquivo com as instruções a serem executadas para criar o banco. 
Na raiz do projeto clonado temos o arquivo `forum.sql`, é ele que contém todo o SQL que deve ser executado para criar o banco de dados e suas respetivas tabelas.

Quase que ia me esquecendo: O projeto clonado deve ser movido para a pasta onde o endereço `http://localhost` aponta, no meu caso, já que estou usando o `XAMPP` o endereço é `C:\xampp\htdocs`.

##

Para ver o projeto rodando acesse o front-end [clicando aqui](http://forumfetapi.vercel.app/)
