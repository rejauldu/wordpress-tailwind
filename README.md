<h1>Installation</h1>
<ol>
<li>First, clone the repo as .zip file</li>
<li>Unzip the file in the WordPress theme directory</li>
<li>Install pnpm package manager from here https://pnpm.io/installation#using-npm</li>
<li>Run pnpm install also run composer install and composer dump-autoload</li>
<li>To start the development run pnpm dev, pnpm tailwind</li>
<li>Open the WordPress project and go to site</li>
</ol>
<h2>How did I create</h2>
<ul>
<li>Install wordpress</li>
<li>Open cmd to the theme</li>
<li>Go to the tailwind website>Tailwind CLI then execute:<br/>
<code>npm install -D tailwindcss<br/>
 npx tailwindcss init</code>
</li>
<li>Configure your template parts (means configure tailwind.config.js's content:[] to locate your files)</li>
<li>Create src/input.css and add the following code:<br/>
<code>@tailwind base;<br/>
 @tailwind components;<br/>
 @tailwind utilities;</code>
</li>
<li>Now run the command to build:<br/>
<code>npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch</code>
</li>
<li>Include output.css to wordpress</li>
</ul>

<p>Youtube: <a href="https://www.youtube.com/watch?v=_8iy0Gfl_9E&t=13s">Link</a></p>
