### Използвани технологии
##### Laravel – версия 8.17.2
##### Blade template engine
##### JS
##### JQuery
##### AJAX
##### MySQL
##### API (https://rapidapi.com/hmerritt/api/imdb-internet-movie-database-unofficial)
##### HTML,CSS,Bootstrap

##### Преглед на проект(снимки и описание)
[MovieDB_user_doc.pdf](https://github.com/FrostAD/MovieDatabase/files/6932745/MovieDB_user_doc.pdf)

 
### Администраторски панел

##### Ако потребителя има роля Админ ще му бъде достъпна опция от падащото меню, която води към администраторския панел
 ![m1](https://user-images.githubusercontent.com/21689292/128217579-cefd667b-4aa7-430b-bcc3-e4929869351d.png)


##### Във самия адм.панел ще има достъп до всички записи на всички модели и възможност за добавяне, редактиране и изтриване на всеки един от тях.
![m2](https://user-images.githubusercontent.com/21689292/128217626-1f95e0d6-038e-4c14-900d-e474adf10d66.png)

 

##### 1 – Отваря нова форма за добавяне на запис
![m3](https://user-images.githubusercontent.com/21689292/128217671-53f6cfdf-1a32-4ed0-be25-a25f91aea47f.png)

 
##### 2- Показва всички данни на конкретен запис
![m4](https://user-images.githubusercontent.com/21689292/128217701-a77223a5-a5c1-4dc9-b42c-516b910a8871.png)
 



##### 3 – Отваря форма за редактиране на вече съществуващ запис
*При попълване на данните за филм се извиква автоматично и връзка към API чрез което се взима IMBD рейтинга(ако има такъв ако ли не му се поставя стойност 0)
![m5](https://user-images.githubusercontent.com/21689292/128217800-c4923739-cf74-4d4b-ac79-ef51c223756c.png)

 
##### 4 – Изтрива записа
##### 5 – Позволява търсенето на конкретен запис
##### 6 – Налични страници със записи
##### 7 – Активиране на филтър(най-често използван за да покаже записи, които се смятат за изтрити)



 
#### Потребителски профил
##### Достъпва се или при кликане върху друг потребител или от падащото меню(по този начин се достъпва собствения профил)
![m6](https://user-images.githubusercontent.com/21689292/128217839-c8ced14d-e3aa-4b20-b61d-72fdc5ee7fb7.png)

 
##### 1 – Показва името на потребителя
##### 2 – Показва текущия общ рейтинг на потребителя (общ рейтинг = рейтинг за размени + рейтинг за постове)
##### 3 – Показва повече информация за потребителя
##### 4 – Показва списък със постовете създадени от потребителя
##### 5 – Показва списък с всички размени на потребителя(отворени и затворени)
##### 6, 7 – Показва различни списъци с филми
##### 9 – Позволява деактивиране на профила(за обикновенния потребител е възможно да деактивира само собствения си профил, докато админът може да деактивира всеки)
##### 8 – Отваря нова страница за промяна на данните(достъпна е само ако потребителя разглежда своя профил)




#### Страница за промяна на потребителските данни
![m7](https://user-images.githubusercontent.com/21689292/128217873-de84c742-baa4-4e7b-851a-927f35130c78.png)

 
##### 1 – Позволява избирането на снимка
##### 2 – Запазва вече избраната снимка от стъпка 1
##### 3 – Позволява смяната на името
##### 4 – Позволява смяната на имейла
##### 5,6 – Позволява смяната на парола
##### 3,4,5,6 – Възможна е и промяната на всяко едно едновременно
##### 7 – Запазва новите промени




#### Навигация
![m8](https://user-images.githubusercontent.com/21689292/128217905-41b94d86-77fe-410f-a6f8-ce26bbba43b4.png)

 
##### 1 – Падащо меню с опции за потребителя
##### 2,3,4 – Показват всички фестивали, събития и филми(с опции за различно сортиране)
![m9](https://user-images.githubusercontent.com/21689292/128217941-7d2ffbbe-7ce4-4633-aad2-68c0ccb30ab0.png)

 
##### 5 – Потребителят може да създаде собствено събитие или да обяви размяна
##### 6 – Позволява търсене на всички видове записи

#### Създаване на събитие
##### Създаването се достъпва от точка 5 на Навигацията и отваря нова форма за попълване
![m10](https://user-images.githubusercontent.com/21689292/128217982-944c3f2a-c22b-4d40-931f-6d231d343389.png)

 
##### 1 – Падащ списък с всички налични филми в сайта
##### 2 – Записване на събитието







#### Обявяване на размяна
##### Достъпва се от точка 5 на Навигацията и отваря нова форма
![m11](https://user-images.githubusercontent.com/21689292/128218021-27b4e264-6b1c-4efe-9c5c-5817db443768.png)

 
##### 1 – Падащ списък с всички налични филми за размяна
#### Разглеждане на конкретен филм
![m12](https://user-images.githubusercontent.com/21689292/128218056-aa0ceb13-f221-4414-aaec-94e11cb6f477.png)


##### 1 – Заглавие на филма
##### 2 – Информация за филма(премиерна дата, времетраене(в минути) и жанрове)
##### 3 – Възможност за потребителя да добави филма в своя списък с желания или в списъка с гледани филми
##### 4 – Информация за IMBD рейтинга(макс.10) на филма и за рейтинг от гласувалите потребители в сайта(макс.5)
##### 5 – Позволява на потребителя да оцени филма
##### 6,7 – Официалния плакат и трейлър на филма
##### 8 – Информация за самия филм 
![m13](https://user-images.githubusercontent.com/21689292/128218111-6052fd45-5117-49cc-a273-3ad0033c1f18.png)

 
##### 1 – Списък с всички актьори, продуценти, сценаристи, музиканти и студия свързани с филма
##### 2 – Повече информация за избран обект(+ линк към него) от списъка в т.1
##### 3 – Възможност да се оценява поста(различно е от оценяването на самия филм)
##### 4 – Информация за потребителя(+ линк за профила му) качил поста
![m14](https://user-images.githubusercontent.com/21689292/128218145-70b14f0c-9777-4ae3-b195-324fcaf1e4ee.png)


##### 1 – Секция с други филми които присъстват в списъка с гледани филми на потребители, които са добавили разглеждания филм
##### 2 – Списък със събития свързани с разглеждания филм
##### 3 – Статистика за броя на свободни размени (при клик върху сумата се отваря нова страница показваща размените)
##### 4,5 – Статистика за това колко хора са добавили съответния филм в своите списъци
##### 6 – Форма за добавяне на коментар
![m15](https://user-images.githubusercontent.com/21689292/128218178-f042ee60-6267-4e91-8131-4e3b4ce92677.png)











#### Разглеждане на конкретно събитие
 ![m15](https://user-images.githubusercontent.com/21689292/128218311-b68804c2-cad4-4073-bb25-240f70fa4c0f.png)

 
##### 1 – Информация за избрания филм(+ линк към трейлъра)
##### 2 – Статуса на текущия потребител за събитието(записан или не)
##### 3 – Информация за събитието дата + място
##### 4 – Описание на събитието
##### 5 – Текущ капацитет
##### 6 – Записаване или отписване за даденото събитие(ако текущия потребител е организатора му опцията за отписване става на отлагане на събитието)











#### Разглеждане на конкретна размяна
 ![m16](https://user-images.githubusercontent.com/21689292/128218325-4c8165c4-cec7-4afc-84d0-1d828c89d88f.png)

##### 1 – Предлаган филм и потребителя, който го предлага
##### 2 – Възможност за избор на филм за размяна

