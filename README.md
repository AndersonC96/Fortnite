# Fortnite Hub 🎮

> Portal de informações do Fortnite com dados em tempo real da API oficial.

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php&logoColor=white)
![MVC](https://img.shields.io/badge/Pattern-MVC-blue?style=flat-square)
![PSR-4](https://img.shields.io/badge/Autoload-PSR--4-green?style=flat-square)
![PSR-12](https://img.shields.io/badge/Code%20Style-PSR--12-green?style=flat-square)

## ✨ Funcionalidades

| Página | Descrição |
|--------|-----------|
| 🏠 **Home** | Dashboard com destaques da loja |
| 🛒 **Loja** | Itens da loja diária com busca e filtros |
| ✨ **Cosméticos** | Catálogo completo com scroll infinito |
| 📰 **Notícias** | Notícias BR e STW com tabs e prioridade |
| 🗺️ **Mapa** | Mapa atual com POIs e fullscreen |
| 🎮 **Modos** | Todos os modos de jogo categorizados |
| 🔍 **Jogador** | Busca de estatísticas de jogadores |

## 🏗️ Arquitetura

```
Fortnite/
├── app/                    # Código da aplicação
│   ├── Controllers/        # Controllers (HomeController, ShopController...)
│   ├── Models/             # Models (FortniteAPI)
│   ├── Views/              # Templates PHP
│   │   ├── layouts/        # Layout principal
│   │   ├── home/           # Views da home
│   │   ├── shop/           # Views da loja
│   │   ├── cosmetics/      # Views de cosméticos
│   │   ├── news/           # Views de notícias
│   │   ├── map/            # Views do mapa
│   │   ├── modes/          # Views de modos
│   │   ├── player/         # Views de jogador
│   │   └── errors/         # Páginas de erro
│   └── Core/               # Core framework
│       ├── Router.php      # Sistema de rotas
│       ├── Controller.php  # Base controller
│       └── Cache.php       # Sistema de cache
├── public/                 # Arquivos públicos (DocumentRoot)
│   ├── index.php           # Front controller
│   ├── autoload.php        # Autoloader PSR-4
│   ├── .htaccess           # Rewrite rules
│   ├── css/                # Estilos
│   └── img/                # Imagens
├── cache/                  # Cache de API
├── config/                 # Configurações
├── .env                    # Variáveis de ambiente
├── .env.example            # Template de variáveis
└── composer.json           # Configuração Composer
```

## 🚀 Instalação

### Pré-requisitos
- PHP 7.4+ (recomendado 8.0+)
- Apache com mod_rewrite
- XAMPP, WAMP ou similar

### Passos

1. **Clone o repositório:**
```bash
git clone https://github.com/seu-usuario/fortnite-hub.git
cd fortnite-hub
```

2. **Configure o ambiente:**
```bash
cp .env.example .env
# Edite .env e configure sua API key
```

3. **Configure o Apache:**
Aponte o DocumentRoot para `/public` ou acesse via:
```
http://localhost/Fortnite/public/
```

4. **(Opcional) Instale dependências do Composer:**
```bash
composer install
```
> O projeto inclui um autoloader standalone, o Composer é opcional.

## 🔧 Configuração

### Variáveis de Ambiente (.env)

```env
# API Configuration
FORTNITE_API_KEY=sua_api_key_aqui
FORTNITE_API_URL=https://fortnite-api.com/v2/

# App Configuration
APP_ENV=development
APP_DEBUG=true

# Cache Configuration (segundos)
CACHE_ENABLED=true
CACHE_TTL=300
```

### Obter API Key
1. Acesse [fortnite-api.com](https://fortnite-api.com/)
2. Crie uma conta e obtenha sua API key
3. Cole no arquivo `.env`

## 🛣️ Rotas

| Método | Rota | Controller | Descrição |
|--------|------|------------|-----------|
| GET | `/` | HomeController@index | Página inicial |
| GET | `/shop` | ShopController@index | Loja diária |
| GET | `/cosmetics` | CosmeticsController@index | Lista de cosméticos |
| GET | `/cosmetics/{id}` | CosmeticsController@show | Detalhes do cosmético |
| GET | `/news` | NewsController@index | Todas as notícias |
| GET | `/news/br` | NewsController@br | Notícias Battle Royale |
| GET | `/news/stw` | NewsController@stw | Notícias Save the World |
| GET | `/map` | MapController@index | Mapa do jogo |
| GET | `/modes` | ModesController@index | Modos de jogo |
| GET | `/player` | PlayerController@search | Busca de jogador |

## 📚 PHP Standards

- **PSR-4**: Autoloading de classes com namespaces
- **PSR-12**: Coding style (indentação, espaçamento, declarações)
- **Type Hints**: Tipagem estrita com `declare(strict_types=1)`
- **PHPDoc**: Documentação de métodos e propriedades

## 🛡️ Segurança

- ✅ API Key em variável de ambiente (não exposta no código)
- ✅ Sanitização com `htmlspecialchars()` para prevenir XSS
- ✅ Headers de segurança no `.htaccess`
- ✅ Proteção contra directory listing
- ✅ `.env` protegido de acesso público

## 🎨 Design

O projeto usa um Design System customizado inspirado no Fortnite:

- **Cores**: Tema escuro com gradientes neon (purple, blue, pink)
- **Tipografia**: Russo One + Poppins
- **Animações**: Transições suaves e efeitos hover
- **Responsivo**: Grid CSS adaptável para mobile

## 📝 APIs Utilizadas

- [Fortnite-API.com](https://fortnite-api.com/) - Dados oficiais
- [FortniteAPI.io](https://fortniteapi.io/) - Mapa do jogo

## 📄 Licença

MIT License - Projeto de portfólio educacional.

---

**Desenvolvido com ❤️ como projeto de portfólio**