# Gravity Labs — site

Site institucional da Gravity Labs (https://www.gravitylabs.com.br/), em PT-BR.

Página única em HTML e CSS estáticos, sem build. O único JavaScript anima a conversa
de exemplo do hero e respeita `prefers-reduced-motion`; sem JavaScript, a conversa aparece inteira.

## Estrutura

- `public/index.html` — o site inteiro (estilos e script inline).
- `public/robots.txt`, `public/sitemap.xml` — SEO.
- `public/og.png`, ícones — imagem de compartilhamento e favicons.
- `vercel.json` — publica a pasta `public` na Vercel.
- `support.js`, `vendor/` — runtime da exportação antiga do mockup "em breve"; não é servido.

## Antes de publicar

Troque `WHATSAPP_NUMBER` em `public/index.html` pelo número com DDI e DDD, só dígitos
(ex.: `5514999999999`), e confira o e-mail de contato.

## Ver localmente

```bash
cd public && python3 -m http.server 8080
```
