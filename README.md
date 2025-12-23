# Fortnite Hub 🎮

> Portal de informações do Fortnite com dados em tempo real da API oficial.

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php&logoColor=white)
![MVC](https://img.shields.io/badge/Pattern-MVC-blue?style=flat-square)
![PSR-4](https://img.shields.io/badge/Autoload-PSR--4-green?style=flat-square)
![PSR-12](https://img.shields.io/badge/Code%20Style-PSR--12-green?style=flat-square)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat-square&logo=docker&logoColor=white)
![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?style=flat-square)

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
├── app/                    # Código da aplicação (MVC)
│   ├── Controllers/        # 7 Controllers
│   ├── Models/             # FortniteAPI com cache
│   ├── Views/              # Templates PHP organizados
│   └── Core/               # Router, Controller, Cache
├── public/                 # Front Controller (DocumentRoot)
│   ├── index.php           # Entry point
│   ├── autoload.php        # PSR-4 Autoloader
│   ├── manifest.json       # PWA Manifest
│   └── sw.js               # Service Worker
├── tests/                  # PHPUnit Tests
├── docker/                 # Docker config
├── .github/workflows/      # CI/CD Pipeline
└── cache/                  # API Cache
```

## 🚀 Quick Start

### Opção 1: XAMPP/Local
```bash
# Clone
git clone https://github.com/seu-usuario/fortnite-hub.git
cd fortnite-hub

# Configure
cp .env.example .env
# Edite .env com sua API key

# Acesse
http://localhost/Fortnite/public/
```

### Opção 2: Docker
```bash
# Build e run
docker-compose up -d

# Acesse
http://localhost:8080/
```

### Opção 3: PHP Built-in Server
```bash
composer start
# Acesse: http://localhost:8000/
```

## 🔧 Configuração

### Variáveis de Ambiente (.env)
```env
FORTNITE_API_KEY=sua_api_key_aqui
FORTNITE_API_URL=https://fortnite-api.com/v2/
APP_ENV=development
APP_DEBUG=true
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
| GET | `/` | HomeController | Página inicial |
| GET | `/shop` | ShopController | Loja diária |
| GET | `/cosmetics` | CosmeticsController | Lista de cosméticos |
| GET | `/cosmetics/{id}` | CosmeticsController | Detalhes |
| GET | `/news` | NewsController | Todas as notícias |
| GET | `/news/br` | NewsController | Battle Royale |
| GET | `/news/stw` | NewsController | Save the World |
| GET | `/map` | MapController | Mapa do jogo |
| GET | `/modes` | ModesController | Modos de jogo |
| GET | `/player` | PlayerController | Busca jogador |

## 🧪 Testes

```bash
# Instalar dependências de desenvolvimento
composer install

# Rodar testes
composer test

# Testes com cobertura
composer test:coverage
```

## 📚 PHP Standards

| Standard | Implementação |
|----------|---------------|
| **PSR-4** | Autoloading via Composer/Standalone |
| **PSR-12** | Coding style com strict_types |
| **Type Hints** | Parâmetros e retornos tipados |
| **PHPDoc** | Documentação completa |

## 🐳 Docker

```bash
# Build
docker build -t fortnite-hub .

# Run
docker run -p 8080:80 -e FORTNITE_API_KEY=sua_key fortnite-hub

# Compose (com environment)
docker-compose up -d
```

## 🔄 CI/CD

O projeto inclui GitHub Actions para:

- ✅ **Lint**: Verificação de código PHP
- ✅ **Test**: Testes automatizados PHPUnit
- ✅ **Security**: Scan de vulnerabilidades
- ✅ **Build**: Build de imagem Docker
- ✅ **Deploy**: Deploy automático (configurável)

## 📱 PWA Features

- ✅ Instalável em dispositivos móveis
- ✅ Funciona offline (cache de assets)
- ✅ Ícones personalizados
- ✅ Splash screen
- ✅ Push notifications (preparado)

## 🛡️ Segurança

- ✅ API Key em variável de ambiente
- ✅ Sanitização XSS com `htmlspecialchars()`
- ✅ Headers de segurança (X-Frame-Options, X-XSS-Protection)
- ✅ HTTPS ready
- ✅ `.env` protegido

## 🎨 Design

- **Theme**: Dark mode inspirado no Fortnite
- **Colors**: Purple (#9d4edd), Blue (#00f0ff), Pink (#ff6b9d)
- **Fonts**: Russo One + Poppins
- **Animations**: Transições suaves, hover effects
- **Responsive**: Mobile-first design

## 📝 APIs

- [Fortnite-API.com](https://fortnite-api.com/) - Dados oficiais
- [FortniteAPI.io](https://fortniteapi.io/) - Mapa

## 📄 Licença

MIT License - Projeto de portfólio educacional.

---

**Desenvolvido com ❤️ como projeto de portfólio**