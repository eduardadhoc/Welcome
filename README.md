## Instal·ació

```
npm install
```
## Maquetació

La maquetació la fem amb [Nunjucks](https://mozilla.github.io/nunjucks/). Hi ha dues carpetes a `/src/`:

+ `/templates/` En aquesta carperta creem els layouts que necessitem per al projecte i que després cridaran les diferents pàgines. També creem els parcials que ens fassin falta.
+ `/pages/` Generem les pàgines que necessitem per la maqueta.

Gulp compila els elements i els desa a `/_maqueta/`

També duplica els assets necessaris i els desa a `/_maqueta/assets/` i la fulla d'estils a `/_maqueta/`

```npm
gulp
```

## Optimització d'imatges

Durant la tasca `gulp` s'optimitzen les imatges que desem a la carpeta `/src/assets/img/` i es desean a `/wp-content/themes/t-b2b/assets/img/`. També es desa una còpia a `/_maqueta/assets/img/`

## Icones

Usem svg per les icones. Treballem a l'arxiu `/src/templates/partials/_svg.njk`

1. Passem el codi svg per [https://jakearchibald.github.io/svgomg/](https://jakearchibald.github.io/svgomg/)
2. Hem de transformar l'element `<svg viewBox = "...">` en un element `<symbol id = "..." viewBox = "...">` i inserir-lo a continuació dins `<svg></svg>`
3. Mostrem el símbol a l'html per mitjà del següent codi:

```html
<svg class="icon" aria-hidden="true" focusable="false">
  <use xlink:href="#twitter"></use>
</svg>
```

Més info a: [https://fvsch.com/svg-icons](https://fvsch.com/svg-icons)

## Descarregar fonts

Per descarregar les Google fonts haurem primer de definir a l'arxiu config.js les famílies i els estils que volem descarregar.

Un cop configurat config.js només cal que fem:

```npm
gulp download:fonts
```
Les fonts es descarregan a `wp-content/themes/t-b2b/assets/fonts/` i es generarà un arxiu scss a `src/scss/base/` amb les font-face corresponents

## Purgar CSS i passar a producció

Un cop haguem enllestit la maquetació purguem els css:

```npm
gulp purge.css
```
...i  copiem els arxius necessaris per passar a producció

```npm
gulp copyPro
```

## .editorconfig

Per donar conscistència a l'estil d'escriptura del codi usem [.editorconfig](https://editorconfig.org/), on es defineixen espais, tabulacions, etc. Si usem VSCode haurem d'instal·lar el [plugin](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig) 
