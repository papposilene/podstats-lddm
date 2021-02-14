<?php $__env->startSection('title', @ucfirst(__('app.api'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.seasons')); ?>
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item">
                    Statistiques par saison (<var>season</var>)<br />
                    <code>https://lddm.psln.nl/api/seasons/data/stats/<var>{season}</var></code><br />
                    <small>
                        Retourne les données de la saison indiquée selon les continents suivants :
                        Afrique, Amériques, Antarctique, Asie, Europe, Océanie, inconnu.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques mensuelles par saison (<var>season</var>)<br />
                    <code>https://lddm.psln.nl/api/seasons/data/months/<var>{season}</var></code><br />
                    <small>
                        Retourne les données de la saison indiquuée par mois pour les mois de naissance et de décès des
                        contributeurs et les mois de première sortie commerciale pour les jeux vidéo.
                    </small>
                </li>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.episodes')); ?>
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item">
                    Contributeurs par continents par épisode (si <var>eid</var>) ou pour tous les épisodes (sans <var>eid</var>)<br />
                    <code>https://lddm.psln.nl/api/episodes/data/continents/<var>{eid?}</var></code><br />
                    <small>
                        Retourne les données selon les continents suivants : Afrique, Amériques, Antarctique, Asie, Europe, Océanie, inconnu.
                    </small>
                </li>
                <li class="list-group-item">
                    Contributeurs par genres par épisode (si <var>eid</var>) ou pour tous les épisodes (sans <var>eid</var>)<br />
                    <code>https://lddm.psln.nl/api/episodes/data/genders/<var>{eid?}</var></code><br />
                    <small>
                        Retourne les données selon les catégories suivantes : groupe de musique, féminin, masculin, neutre, inconnu.
                    </small>
                </li>
                <li class="list-group-item">
                    Contributeurs par continents par épisode (<var>eid</var>)<br />
                    <code>https://lddm.psln.nl/api/episodes/data/genres/<var>{eid}</var></code><br />
                    <small>
                        Retourne les données par genres pour les jeux vidéo cités dans l'épisode indiqué.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques mensuelles par épisode (si <var>eid</var>) ou pour tous les épisodes (sans <var>eid</var>)<br />
                    <code>https://lddm.psln.nl/api/episodes/data/months/<var>{eid?}</var></code><br />
                    <small>
                        Retourne les données par mois pour les mois de naissance et de décès des contributeurs et
                        les mois de première sortie commerciale pour les jeux vidéo.
                    </small>
                </li>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.manufacturers')); ?>
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item">
                    Liste des constructeurs<br />
                    <code>https://lddm.psln.nl/api/manufacturers/json</code><br />
                    <small>
                        Retourne l'ensemble des données sur les constructeurs.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques des consoles (pour un constructeur si <var>uuid</var>) ou pour toutes les consoles (sans <var>uuid</var> d'un constructeur)<br />
                    <code>https://lddm.psln.nl/api/manufacturers/data/consoles/<var>{uuid?}</var></code><br />
                    <small>
                        Retourne les données selon les types de consoles suivants : arcade, portable, console de salon, micro-ordinateur, ordinateur, hybride.
                    </small>
                </li>
                <li class="list-group-item">
                    Constructeurs par continents<br />
                    <code>https://lddm.psln.nl/api/manufacturers/data/continents</code><br />
                    <small>
                        Retourne les données de la saison indiquée selon les continents suivants :
                        Afrique, Amériques, Antarctique, Asie, Europe, Océanie, inconnu.
                    </small>
                </li>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.consoles')); ?>
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item">
                    Liste des consoles<br />
                    <code>https://lddm.psln.nl/api/consoles/json</code><br />
                    <small>
                        Retourne l'ensemble des données sur les consoles.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques des consoles pour chaque constructeur<br />
                    <code>https://lddm.psln.nl/api/consoles/data/consoles</code><br />
                    <small>
                        Retourne les données pour une utilisation via Chart.js.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques des genres de jeux vidéo pour chaque console (si <var>uuid</var>) ou pour toutes les consoles (sans <var>uuid</var>)<br />
                    <code>https://lddm.psln.nl/api/consoles/data/genres/<var>{uuid?}</var></code><br />
                    <small>
                        Retourne les données pour une utilisation via Chart.js.
                    </small>
                </li>
                <li class="list-group-item">
                    Statistiques des types de consoles<br />
                    <code>https://lddm.psln.nl/api/consoles/data/types/</code><br />
                    <small>
                        Retourne les données pour une utilisation via Chart.js.
                    </small>
                </li>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/api.blade.php ENDPATH**/ ?>