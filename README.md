## Desenvolvido em:

[Laravel](https://laravel.com/docs/11.x) (11)

## Tecnologias:

1. [PHP](https://www.php.net/) (8.3)
2. [MySQL](https://www.mysql.com) (9)
3. [Composer](https://getcomposer.org/) (2.1)

### Para rodar o projeto:

Projeto dockerizado, rode os comandos abaixo para o projeto funcionar:

```sh
docker-compose up
```

este desafio foi desenvolvido em TDD, então se você quiser ver todos os testes pode rodar este comando:

```bash
docker exec -it backend sh -c "php artisan test"
```

# Observações

Por padrão, o Laravel implementa a arquitetura MVC. Implementei arquitetura DDD seguindo princípios do SOLID,
usando actions, repositórios e injeção de dependência.

# O que faria de melhor?

Neste projeto utilizei o VueJS pelo CDN, mas em projetos maiores usario o vue desacoplado do backend, visando facilitar
a manutenção do projeto. Escolho o
Nuxt.js, um framework baseado em Vue.js, devido às suas robustas funcionalidades para otimização de SEO e renderização
eficiente no servidor.

Poderia ter utilizado camadas de caching para listagem de folgas do funcionário, isso traria um bom tempo de resposta e
menos processamento do banco e dos servidores.

Algumas regras mais complexos para a folga podem ser criadas, então isolar isso pode fazer sentido também.
