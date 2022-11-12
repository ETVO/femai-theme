from cProfile import run
import subprocess
import os

modules = 'laravel-mix bootstrap bootstrap-icons @popperjs/core'

print("")
print("oooooooooooo    ooooooooooooooo    oooo       oooo      oooooooooooo ")
print("oooooooooooo    ooooooooooooooo    oooo       oooo     oooooooooooooo")
print("oooo                 ooooo         oooo       oooo     oooo      oooo")
print("oooo                 ooooo         oooo       oooo     oooo      oooo")
print("ooooooooo            ooooo         oooo       oooo     oooo      oooo")
print("ooooooooo            ooooo         oooo       oooo     oooo      oooo")
print("oooo                 ooooo          oooo     oooo      oooo      oooo")
print("oooo                 ooooo           oooo   oooo       oooo      oooo")
print("oooooooooooo         ooooo             ooooooo         oooooooooooooo")
print("oooooooooooo         ooooo              ooooo           oooooooooooo ")

print("\nby Estevão Rolim\n")

print("• Initialize WordPress Theme •")

exit

theme_info = {
    'theme_name': input('Theme Name: '), 
    'theme_uri': input('Theme URI: '), 
    'author': input('Author: '), 
    'author_uri': input('Author URI: '), 
    'desc': input('Description: ')
}

print("\n• Creating style.css\n")
stylesheet = open('style.css', 'x', encoding="utf-8")
stylesheet.write("""/*
Theme Name: {}
Theme URI: {}
Author: {}
Author URI: {}
Description: {}
Version: 1.0
*/""".format(*list(theme_info.values())))
stylesheet.close()

print("• Initializing Node Modules")
subprocess.check_call('npm init -y', shell=True)

print("• Installing Laravel Mix, Bootstrap, Bootstrap Icons and other dependencies")
subprocess.check_call('npm install ' + modules + ' --save-dev', shell=True)

print("• Creating webpack.mix.js")
webpack = open('webpack.mix.js', 'x')
webpack.write("""// webpack.mix.js

let mix = require('laravel-mix');

mix.disableSuccessNotifications();

// Compile
mix.js('src/js/main.js', 'js')
.js('src/js/admin.js', 'js')
.sass('src/scss/main.scss', 'css')
.sass('src/scss/admin.scss', 'css')
.sass('src/scss/bootstrap.scss', 'css')
.setPublicPath('assets');

// Copy bootstrap-icons module
mix.copy('node_modules/bootstrap-icons/font/', 'assets/fonts/bootstrap-icons');""")
webpack.close()
    
os.mkdir('src')

path = os.path.join('src', 'js')
os.mkdir(path)

admin = open('src/js/admin.js', 'x')
admin.write('')
admin.close()

main = open('src/js/main.js', 'x')
main.write("import 'bootstrap';")
main.close()

path = os.path.join('src', 'scss')
os.mkdir(path)

mainscss = open('src/scss/main.scss', 'x')
mainscss.close()

bs = open('src/scss/bootstrap.scss', 'x')
bs.write("@import '~bootstrap/scss/bootstrap';")
bs.close()

admin = open('src/scss/admin.scss', 'x')
admin.close()


print("• Creating .gitignore")
webpack = open('.gitignore', 'x')
webpack.write("""# .gitignore
package-lock.json
node_modules/
.vscode/
assets/css
assets/js
assets/fonts/bootstrap-icons""")
webpack.close()

template_files = [
    ['functions.php', 'Theme functions and definitions'],
    ['404.php'],
    ['footer.php'],
    ['header.php'],
    ['home.php'],
    ['index.php'],
    ['page.php'],
    ['search.php'],
    ['searchform.php'],
    ['single.php'],
]

print('• Creating WordPress template files')
for f in template_files:
    newfile = open(f[0], 'x')
    if len(f) > 1: 
        newfile.write("<?php\n/**\n * " + f[1] + "\n *\n * @package WordPress\n */\n")
    newfile.close()


print("\n• Running npx mix")
subprocess.run('npx mix', shell=True, check=False)

print('• Finished initializing WordPress theme')

run_watch = input('• Initialize git repo (Y/N)? ')
if run_watch == 'y' or run_watch == 'Y':
    subprocess.check_call('git init', shell=True)
    subprocess.check_call('git add -A', shell=True)
    subprocess.check_call('git commit -m "Init"', shell=True)

run_watch = input('• Run npx mix watch (Y/N)? ')
if run_watch == 'y' or run_watch == 'Y':
    subprocess.run('npx mix watch', shell=True, check=False)