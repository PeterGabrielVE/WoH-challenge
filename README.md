# World of HIT (WoH) - Backend Challenge


Bienvenidos a World of HIT A.K.A. WoH. WoH es un juego MMORPG NO LINEAL.

El objetivo principal de este ejercicio es evaluar tu proceso para resolver problemas, como tu habilidad para escribir codigo entendible, limpio y reusable. No hay reglas estrictas o preguntas engañosas.

## Introduccion


Queremos desarrollar una API para un juego PvP (Player vs Player) donde dos jugadores se enfrentaran hasta que solo uno quede en pie. Los jugadores podran tener equipados items que los ayuden en sus batallas.

## 📜 Instrucciones


### 🙍🏻‍♂️Jugador

- Cada jugador tiene:
    - Nombre
    - Email
    - Tipo
        - 👨🏻Humano
        - 🧟‍♂️Zombie
- Al crearse un jugador comienza con ❤️ 100 puntos de vida.
- Si el jugador no tiene items, por defecto tiene 5 puntos de ataque 🗡 y 5 puntos de defensa 🛡.
- Los puntos de ataque 🗡 de un jugador estan dados por sus 5 puntos + la sumatoria de puntos ataque de sus items.
- Los puntos de defensa 🛡 de un jugador estan dados por sus 5 puntos + la sumatoria de puntos de defensa de sus items.

### ⚒ Items

- Cada item tiene:
    - Nombre
    - Tipo
        - 🥾Bota
        - 🧥Armadura
        - ⚔️ Arma
    - Cantidad de puntos de defensa 🛡. Pueden ser 0.
    - Cantidad de puntos de ataque 🗡. Pueden ser 0.
- Un jugador puede tener equipado solo un item de cada tipo pero puede tener un inventario con todos los items que quiera.

### 🤺Ataque

- Existen tres tipos de ataque:
    - Cuerpo a cuerpo ⚔️. Daño total = Puntos de ataque.
    - A distancia 🏹. Daño total = Puntos de ataque * 0.8.
    - Ulti 💀. Daño total = Puntos de ataque x 2.
- Cada ataque le resta vida al otro jugador. La cantidad de vida que pierde el defensor es Daño total ataque - Puntos de defensa del defensor.
- Como minimo un ataque saca 1 punto de ❤️ vida al defensor.
- Para tirar la Ulti el ultimo ataque tuvo que haber sido un ataque a cuerpo a cuerpo.
- No se puede atacar a jugadores que ya estan muertos.

## ✅ Tareas


Definir una REST API que permita cumplir con los siguientes requerimientos.

- Como administrador quiero dar de alta un jugador.
- Como administrador quiero dar de alta y modificar items.
- Como jugador quiero equiparme un item.
- Como jugador quiero atacar a otro jugador con un golpe cuerpo a cuerpo.
- Como jugador quiero atacar a otro jugador con un golpe a distancia.
- Como jugador quiero atacar a otro jugador con mi ulti.
- Como administrador queremos ver que jugadores pueden tirar su ulti.

**Extras**

- Hacer test unitarios
- Hostear la solucion

## 🤝 Entregable


- Se debe entregar un repo de github con la solución
- Puede estar programado en cualquier framework MVC. (si es en laravel mejor)
