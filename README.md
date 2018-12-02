## Anywhere: a manager for School Projects and Disciplines
Project developed under the Integrated Project of Language Engineering of the Master's Degree in Informatics Engineering (University of Minho).

This project consists in the development of an information system responsible for the aggregation, validation and release of contents referring to projects submitted by students from various disciplines and institutions. This system allows to receive multiple compressed files and initiate a validation process, which may be a simple verification of the mandatory files presence or even an automatic evaluation (with rules and criteria previously defined by the teacher). It is also possible to manage relevant aspects in disciplines, groups of students, teaching team and work-groups or generate grades automatically. This platform also allows the validated content to be made available in an open-access online repository.

*Used Technologies: PHP, CodeIgniter, MVC, PERL, Ruby, C, MySQL, JavaScript, JQuery, HTML, XML, CSS, Bootstrap, JSON, DSL, phpMyAdmin, NetBeans, GitHub, Trello, LaTeX, Texmaker, among others.*

![Homepage](https://raw.githubusercontent.com/david-branco/anywhere/master/screenshots/evento1.png)<br>

[More Screenshots](https://github.com/david-branco/anywhere/tree/master/screenshots)<br>
[Database Model](https://github.com/david-branco/anywhere/tree/master/screenshots/bd.png)

The system has among its main functionalities:
- Responsive Web interface to the various usual formats;
- Application made available using the SaaS model (Software as a Service);
- Authentication service for the users and administrators;
- Forms for the system information management with validation of the inserted data;
- Persistence of the information inserted in data repositories;
- Logs System that monitors all the platform activity (sending automatically an e-mail to the admins in case of critical error);
- Public profile and custom dashboard for the various types of users;
- Bar and search page of all the public system information (e.g. repository with validated information, works with non-private status, profiles of disciplines, teachers and students, etc.);
- Navigation bar for fast and efficient access to the multiple features;
- Integration wih the MyAcademy platform;
- Among other features.

The system can be used by 4 types of entities that have roles with different functionalities:
- Administrator:
    * Manage the entire system through the interface, forms and mechanisms created for that purpose;
    * Send e-mails to all users, individually, or entities sets;
    * All the features of the remaining users;
    * Among other options.

- Teacher:
    * Create and manage the account and personal information;
    * CRUD and enable/disable disciplines, projects, students and work-groups;
    * Generate and send invitation to enroll in a discipline (students and teachers);
    * Create work-groups automatically (e.g. with minimum/maximum number of elements, partial or total set of students, etc.);
    * Create, import and export grades in multiples formats (e.g. HTML, XML, PDF);
    * Define the type of content visualization in the repository (public, protected or private);
    * Send e-mail to students and teaching staff (individually, by work-group or discipline);
    * Limit the period of working groups formation;
    * Define a limit for project submissions;
    * Define the possibility of deliver projects late (e.g. with/without penalty, quantify the penalisation, etc.);
    * Correction and evaluation (manual/mixed/automatic) of projects;
    * Manage information related to academic events in a personalized calendar;
    * Create a chat room for project or discipline to interact with students and remaing teaching staff;
    * Define the date for a delivery be available in the public repository;
    * All the options of a user not registered in the system;
    * Among other features.

- Student:
    * Create and manage the account and personal information;
    * Manage disciplines (e.g. enroll, consult information about the teaching team and other students, etc.);
    * Manage projects (e.g. consult information and requirements, submit multiple versions, etc.);
    * Manage work-groups (e.g. create, enter/exit, consult information of the remaining elements, etc.);
    * Participate in chat rooms with elements of a particular project or discipline;
    * Send individual or general e-mail to teachers and students;
    * Check the submissions status;
    * Consult projects and disciplines grades;
    * Manage information related to personal and academic events (e.g. jobs, tests, disciplines, etc.) in a personalized calendar;
    * All the options of a user not registered in the system;
    * Among other features.

- User of the repository:
    * Access the online repository with all validated public access disciplines and projects;
    * Search by topic, keyword, student and teacher;
    * Download the full project or a particular file;
    * Consult information and navigate the project;
    * Contact authors and project supervisors;
    * View statistics;
    * Among other features.

---

## Anywhere: um gestor de Disciplinas e Trabalhos Práticos
Projecto desenvolvido no âmbito do Projecto Integrado de Engenharia de Linguagens do Mestrado em Engenharia Informática (Universidade do Minho).

Este projecto consiste no desenvolvimento de um sistema de informação responsável pela agregação, validação e disponibilização de conteúdos referentes a trabalhos práticos submetidos por alunos de várias disciplinas e instituições. Este sistema permite receber múltiplos ficheiros compactados e iniciar um processo de validação, que poderá passar por uma simples verificação da presença de ficheiros obrigatórios ou até mesmo uma avaliação automática da submissão (com regras e critérios previamente definidos pelo docente). É também possível gerir aspectos relevantes em disciplinas, conjuntos de alunos, equipas de docentes, grupos de trabalho e gerar pautas automaticamente. Esta plataforma permite também a disponibilização do conteúdo validado num repositório online de acesso livre.

*Tecnologias Utilizadas: PHP, CodeIgniter, MVC, PERL, Ruby, C, MySQL, JavaScript, JQuery, HTML, XML, CSS, Bootstrap, JSON, DSL, phpMyAdmin, NetBeans, GitHub, Trello, LaTeX, Texmaker, entre outras.*

![Homepage](https://raw.githubusercontent.com/david-branco/anywhere/master/screenshots/evento1.png)<br>

[Mais Screenshots](https://github.com/david-branco/anywhere/tree/master/screenshots)<br>
[Modelo Base de Dados](https://github.com/david-branco/anywhere/tree/master/screenshots/bd.png)

O sistema possui entre as suas funcionalidades principais:
- Interface Web responsive para os vários formatos usuais;
- Aplicação disponibilizada utilizando o modelo SaaS (Software as a Service);
- Serviço de autenticação para utilizadores e administradores;
- Formulários para gestão de informação do sistema com validação dos dados inseridos;
- Persistência da informação inserida em repositórios de dados;
- Sistema de Logs que monitoriza toda a actividade na plataforma (com envio automático de e-mail aos administradores em caso de erro critico); 
- Perfil público e Dashboard personalizada para os vários tipos de utilizadores;
- Barra e página de pesquisa de toda a informação pública do sistema (e.g. repositório com informação validada, trabalhos com estatuto não privado, perfis de disciplinas, docentes e alunos, etc.);
- Barra de navegação para um rápido e eficiente acesso às múltiplas funcionalidades;
- Integração com a plataforma MyAcademy;
- Entre outras funcionalidades.

O sistema pode ser utilizado por 4 tipos entidades que possuem papéis com funcionalidades distintas: 
- Administrador:
    * Gerir todo o sistema através do interface, formulários e mecanismos criados para o efeito;
    * Enviar e-mails para todos os utilizadores, individualmente ou conjuntos de entidades;
    * Todas as funcionalidades dos restantes utilizadores;
    * Entre outras opções.

- Docente:
    * Criar conta no sistema e gerir a sua informação pessoal;
    * CRUD e activar/desactivar disciplinas, trabalhos, alunos e grupos de trabalho;
    * Gerar e enviar convite para ingresso numa disciplina (alunos e docentes);
    * Criar grupos de trabalho automaticamente (e.g. com número mínimo/máximo de elementos, conjunto parcial ou total dos alunos, etc.);
    * Criar, importar e exportar pautas em vários formatos (e.g. HTML, XML, PDF);
    * Definir tipo de visualização do conteúdo no repositório (público, protegido ou privado);
    * Enviar e-mail a alunos e equipa docente (individualmente, por grupos de trabalho ou disciplina);
    * Limitar o prazo de formação de grupos de trabalho;
    * Definir limite de submissões de trabalhos;
    * Definir possibilidade de envios de trabalhos com atraso (e.g. com/sem penalização, quantificar a penalização, etc.);
    * Correcção e avaliação manual/mista/automática de trabalhos;
    * Gerir informação relativa a eventos académicos num calendário personalizado;
    * Criar sala de chat por trabalho ou disciplina para interacção com os alunos e restante equipa docente;
    * Definir a data em que uma submissão entra no repositório público;
    * Todas as funcionalidades de um utilizador não registado no sistema;
    * Entre outras funcionalidades.

- Aluno:
    * Criar conta no sistema e gerir a sua informação pessoal;
    * Gerir as suas disciplinas (e.g. inscrever-se, consultar informação sobre equipa docente e outros alunos, etc.);
    * Gerir os seus trabalhos (e.g. consultar informação e requisitos, submeter múltiplas versões, etc.);
    * Gerir os seus grupos de trabalho (e.g. criar, entrar/sair, consultar informação dos restantes elementos, etc.);
    * Participar em salas de chat com elementos de um determinado trabalho ou disciplina;
    * Enviar e-mail individual ou geral a docentes ou alunos;
    * Verificar o estado das suas submissões;
    * Consultar pautas dos trabalhos e disciplinas;
    * Gerir informação relativa a eventos pessoais e académicos (e.g. trabalhos, testes, disciplinas, etc.) num calendário personalizado;
    * Todas as funcionalidades de um utilizador não registado no sistema;
    * Entre outras funcionalidades.

- Utente do repositório:
    * Aceder ao repositório online com todos as disciplinas e trabalhos validados de acesso público;
    * Realizar pesquisas por tema, palavra-chave, aluno e docente;
    * Fazer download do projecto completo ou de um ficheiro em particular;
    * Consultar informação e navegar nos projectos;
    * Contactar autores e orientadores de projectos;
    * Visualizar estatísticas;
    * Entre outras funcionalidades.