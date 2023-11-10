<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use App\Entity\Promotion;
use App\Entity\ResponsableTerritorial;
use App\Entity\User;
use App\Entity\Apprenant;
use App\Entity\DonneesAdministratives;
use App\Entity\DonneesPedagogiques;
use App\Entity\Formateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestFixtures extends Fixture implements FixtureGroupInterface
{
    private $faker;
    private $hasher;
    private $manager;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = FakerFactory::create('fr_FR');
        $this->hasher = $hasher;
    }

    public static function getGroups(): array
    {
        return ['test'];
    }

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;


        $this->loadPromotions();
        $this->loadFormateurs();
        $this->chargerFormateursEtAssocier();
        $this->loadsApprenants();
        $this->loadResponsableTerritorial();
        $this->loadAdministrateur();
    }


    public function loadsApprenants(): void
    {
        $promotionRepository = $this->manager->getRepository(Promotion::class);
        $promos = $promotionRepository->findAll();
        $promo1 = $promotionRepository->find(1);
        $promo2 =  $promotionRepository->find(2);
        $promo3 =  $promotionRepository->find(3);

        $datas = [
            [
                'nom' => 'Foo',
                'prenom' => 'Foo',
                'genre' => 'masculin',
                'dateNaissance' => new \DateTime('2000-01-02'),
                'telephone' => '0760055894',
                'consentement' => false,

                'email' => 'foo@exemple.com',
                'password' => '123',
                'roles' => ['ROLE_APPRENANT'],

                'lieuNaissance' => 'Lens',
                'email' => 'foo2@exemple.com',
                'paysNaissance' => 'France',
                'adresse' => '8 rue des Peupliers',
                'codePostal' => '62 300',
                'commune' => 'Lens ',
                'nationalite' => 'francaise',
                'situationProfessionnelle' => 'RSA',
                'numeroPoleEmploi' => 'W8549658',
                'derniereClasseSuivie' => 'aucune',
                'dernierDiplomeObtenu' => 'Baccalauréat',

                'compteGithub' => 'Github/foo6325',
                'compteDiscord' => 'Discord/foo1547',
                'compteLinkedin' => 'Linkedin/foo8468',

                'promotions' => $promo1

            ],
            [
                'nom' => 'Bar',
                'prenom' => 'Bar',
                'genre' => 'masculin',
                'dateNaissance' => new \DateTime('2002-05-02'),
                'telephone' => '0760013464',
                'consentement' => false,

                'email' => 'bar@exemple.com',
                'password' => '123',
                'roles' => ['ROLE_APPRENANT'],

                'lieuNaissance' => 'Lievin',
                'email' => 'bar2@exemple.com',
                'paysNaissance' => 'France',
                'adresse' => '9 rue des Meuniers',
                'codePostal' => '62 256',
                'commune' => 'Lens',
                'nationalite' => 'francaise',
                'situationProfessionnelle' => 'ARE',
                'numeroPoleEmploi' => 'W85456856',
                'derniereClasseSuivie' => 'Terminal',
                'dernierDiplomeObtenu' => 'Baccalauréat',

                'compteGithub' => 'Github/bar9625',
                'compteDiscord' => 'Discord/bar9631',
                'compteLinkedin' => 'Linkedin/bar7469',

                'promotions' => $promo2,

            ],
            [
                'nom' => 'Baz',
                'prenom' => 'Baz',
                'genre' => 'masculin',
                'dateNaissance' => new \DateTime('1999-07-03'),
                'telephone' => '0796315464',
                'consentement' => false,

                'email' => 'baz@exemple.com',
                'password' => '123',
                'roles' => ['ROLE_APPRENANT'],

                'lieuNaissance' => 'Loison',
                'email' => 'baz2@exemple.com',
                'paysNaissance' => 'France',
                'adresse' => '5 rue NeufChateau',
                'codePostal' => '65 896',
                'commune' => 'Loison',
                'nationalite' => 'francaise',
                'situationProfessionnelle' => 'ASS',
                'numeroPoleEmploi' => 'W85496356',
                'derniereClasseSuivie' => 'aucune',
                'dernierDiplomeObtenu' => 'Licence',

                'compteGithub' => 'Github/baz7425',
                'compteDiscord' => 'Discord/baz1631',
                'compteLinkedin' => 'Linkedin/baz7359',

                'promotions' => $promo3


            ]
        ];

        foreach ($datas as $key => $data) {
            $apprenant = new Apprenant();
            $apprenant->setNom($data['nom']);
            $apprenant->setPrenom($data['prenom']);
            $apprenant->setGenre($data['genre']);
            $apprenant->setDateNaissance($data['dateNaissance']);
            $apprenant->setTelephone($data['telephone']);
            $apprenant->setConsentement($data['consentement']);

            $apprenant->setPromotion($data['promotions']);

            $this->manager->persist($apprenant);

            $user = new User();
            $user->setEmail($data['email']);
            $password = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $user->setApprenant($apprenant);

            $this->manager->persist($user);

            $donneesAdministratives = new DonneesAdministratives();
            $donneesAdministratives->setLieuNaissance($data['lieuNaissance']);
            $donneesAdministratives->setEmail($data['email']);
            $donneesAdministratives->setpaysNaissance($data['paysNaissance']);
            $donneesAdministratives->setAdresse($data['adresse']);
            $donneesAdministratives->setCodePostal($data['codePostal']);
            $donneesAdministratives->setCommune($data['commune']);
            $donneesAdministratives->setNationalite($data['nationalite']);
            $donneesAdministratives->setSituationProfessionnelle($data['situationProfessionnelle']);
            $donneesAdministratives->setNumeroPoleEmploi($data['numeroPoleEmploi']);
            $donneesAdministratives->setDerniereClasseSuivie($data['derniereClasseSuivie']);
            $donneesAdministratives->setDernierDiplomeObtenu($data['dernierDiplomeObtenu']);

            $donneesAdministratives->setApprenant($apprenant);

            $this->manager->persist($donneesAdministratives);

            $donneesPedagogiques = new DonneesPedagogiques();
            $donneesPedagogiques->setCompteGithub($data['compteGithub']);
            $donneesPedagogiques->setCompteDiscord($data['compteDiscord']);
            $donneesPedagogiques->setCompteLinkedin($data['compteLinkedin']);

            $donneesPedagogiques->setApprenant($apprenant);

            $this->manager->persist($donneesPedagogiques);
        }
        $this->manager->flush();

        for ($i = 0; $i < 200; $i++) {
            $apprenant = new Apprenant();
            $prenom = $this->faker->firstName();
            $nom = $this->faker->lastName();
            $apprenant->setNom($nom);
            $apprenant->setPrenom($prenom);
            $genre = $this->faker->randomElement(['masculin', 'feminin']);
            $apprenant->setGenre($genre);
            $dateNaissance = $this->faker->dateTimeBetween('-40 years', '-20 years');
            $apprenant->setDateNaissance($dateNaissance);
            $apprenant->setTelephone($this->faker->phoneNumber());
            $apprenant->setConsentement($this->faker->boolean(false));
            $promotion = $this->faker->randomElement($promos);
            $apprenant->setPromotion($promotion);



            $user = new User();
            $email = strtolower($nom) . '.' . strtolower($prenom) . '@exemple.com';
            $user->setEmail($email);
            $password = $this->hasher->hashPassword($user, '123');
            $user->setPassword($password);
            $user->setRoles(['ROLE_APPRENANT']);

            $user->setApprenant($apprenant);

            $this->manager->persist($apprenant);
            $this->manager->persist($user);

            $donneesAdministratives = new DonneesAdministratives();
            $donneesAdministratives->setLieuNaissance($this->faker->city());
            $numberEmail = $this->faker->randomNumber(3) . '@gmail.com';
            $donneesAdministratives->setEmail($numberEmail);
            $donneesAdministratives->setPaysNaissance($this->faker->country());
            $donneesAdministratives->setAdresse($this->faker->streetAddress());
            $donneesAdministratives->setCodePostal($this->faker->postcode());
            $donneesAdministratives->setCommune($this->faker->city());
            $nationalite = $this->faker->randomElement(['francaise', 'belge']);
            $donneesAdministratives->setNationalite($nationalite);
            $situationProfessionnelle = $this->faker->randomElement(['RSA', 'ARE', 'Minima sociaux', 'Aucune', 'Travailleur handicape']);
            $donneesAdministratives->setSituationProfessionnelle($situationProfessionnelle);
            $numeroPoleEmploi = $this->faker->numerify('W########');
            $donneesAdministratives->setNumeroPoleEmploi($numeroPoleEmploi);
            $derniereClasseSuivie = $this->faker->randomElement(['CAP', 'aucune', 'BEP', 'DES', 'Formation en ligne', 'Auto-Éducation']);
            $donneesAdministratives->setDerniereClasseSuivie($derniereClasseSuivie);
            $diplomeObtenu = $this->faker->randomElement(['Diplôme de Secourisme', 'Certificat en Sûreté', 'Baccalauréat', 'License', 'BEP', 'CAP', 'DES', 'BTS', 'DUT']);
            $donneesAdministratives->setDernierDiplomeObtenu($diplomeObtenu);

            $donneesAdministratives->setApprenant($apprenant);

            $this->manager->persist($donneesAdministratives);

            $userName = strtolower($nom);
            $donneesPedagogiques = new DonneesPedagogiques();

            $compteGithub = 'github/' . $userName . $this->faker->unique()->randomNumber(4);
            $donneesPedagogiques->setCompteGithub($compteGithub);

            $compteDiscord = '#' . $userName . $this->faker->unique()->randomNumber(4);
            $donneesPedagogiques->setCompteDiscord($compteDiscord);

            $compteLinkedin = 'Linkedin/' . $userName . $this->faker->unique()->randomNumber(4);
            $donneesPedagogiques->setCompteLinkedin($compteLinkedin);

            $donneesPedagogiques->setApprenant($apprenant);

            $this->manager->persist($donneesPedagogiques);
        }
        $this->manager->flush();
    }

    public function loadPromotions(): void
{
    $datas = [
        [
            'nom' => 'Promo Foo',
            'description' => 'lorem ipsum',
            'dateFin' => new \DateTime('2024-02-08'),
        ],
        [
            'nom' => 'Promo Bar',
            'description' => 'lorem ipsum',
            'dateFin' => new \DateTime('2023-12-21'),
        ],
        [
            'nom' => 'Promo Baz',
            'description' => 'lorem ipsum',
            'dateFin' => new \DateTime('2024-05-31'),
        ],
    ];

    foreach ($datas as $data) {
        $promotion = new Promotion();
        $promotion->setNom($data['nom']);
        $promotion->setDescription($data['description']);
        $promotion->setDateFin($data['dateFin']);

        $this->manager->persist($promotion);
    }

    for ($i = 0; $i < 20; $i++) {
        $promotion = new Promotion();
        $promotion->setNom($this->faker->word);
        $promotion->setDescription($this->faker->sentence);
        $promotion->setDateFin($this->faker->dateTimeBetween('+6 months', '+8 months'));

        $this->manager->persist($promotion);
    }

    $this->manager->flush();
}

public function loadFormateurs(): void
{
    $promotionRepository = $this->manager->getRepository(Promotion::class);
    $promotions = $promotionRepository->findAll();
    
    $datas = [
        [
            'email' => 'dupont@exemple.com',
            'password' => '123',
            'roles' => ['ROLE_FORMATEUR'],
            'nom' => 'Laurent',
            'prenom' => 'Dupont',
        ],
        [
            'email' => 'sparow@exemple.com',
            'password' => '123',
            'roles' => ['ROLE_FORMATEUR'],
            'nom' => 'Jack',
            'prenom' => 'Sparow',
        ]
    ];

    foreach ($datas as $data) {
        $formateur = new Formateur();
        $formateur->setNom($data['nom']);
        $formateur->setPrenom($data['prenom']);

        $user = new User();
        $user->setEmail($data['email']);
        $password = $this->hasher->hashPassword($user, $data['password']);
        $user->setPassword($password);
        $user->setRoles($data['roles']);

        $user->setFormateur($formateur);

        $this->manager->persist($formateur);
    }

    for ($i = 0; $i < 10; $i++) {
        $formateur = new Formateur();
        $formateur->setNom($this->faker->lastName());
        $formateur->setPrenom($this->faker->firstName());

        $user = new User();
        $user->setEmail($this->faker->safeEmail());
        $password = $this->hasher->hashPassword($user, '123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_FORMATEUR']);

        $user->setFormateur($formateur);

        $nbPromos = random_int(1, 3);
        $shortList = $this->faker->randomElements($promotions, $nbPromos);

        foreach ($shortList as $promo) {
            $formateur->addPromotion($promo);
        }

        $this->manager->persist($formateur);
    }

    $this->manager->flush();
}

public function chargerFormateursEtAssocier(): void
{
    $promotionRepository = $this->manager->getRepository(Promotion::class);
    $promotions = $promotionRepository->findAll();
    $formateurs = $this->manager->getRepository(Formateur::class)->findAll();

    foreach ($promotions as $promotion) {
        $nbFormateurs = random_int(1, 3);
        $formateursAleatoires = $this->faker->randomElements($formateurs, $nbFormateurs);

        foreach ($formateursAleatoires as $formateur) {
            $promotion->addFormateur($formateur);
        }
    }

    $this->manager->flush();
}


    public function loadResponsableTerritorial(): void
    {
        $datas = [
            [
                'nom' => 'Christian',
                'prenom' => 'Clafssin',

                'email' => 'christian@exemple.com',
                'password' => '123',
                'roles' => ['ROLE_RESPONSABLE_TERRITORIAL'],

            ],
        ];

        foreach ($datas as $data) {
            $responable = new ResponsableTerritorial();
            $responable->setNom($data['nom']);
            $responable->setPrenom($data['prenom']);


            $user = new User();
            $user->setEmail($data['email']);
            $password = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $user->setResponsableTerritorial($responable);

            $this->manager->persist($user);
        }

        for ($i = 0; $i < 2; $i++) {
            $responable = new ResponsableTerritorial();
            $responable->setNom($this->faker->lastName());
            $responable->setPrenom($this->faker->firstName());

            $user = new User();
            $user->setEmail($this->faker->safeEmail());
            $password = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $user->setResponsableTerritorial($responable);

            $this->manager->persist($user);
        }
        $this->manager->flush();
    }
    public function loadAdministrateur(): void
    {
        $datas = [
            [
                'nom' => 'Claire',
                'prenom' => 'Dupont',

                'email' => 'claire@hotmailfr',
                'password' => '123',
                'roles' => ['ROLE_ADMIN']
            ]
        ];
        foreach ($datas as $data) {
            $administrateur = new Administrateur();
            $administrateur->setNom($data['nom']);
            $administrateur->setPrenom($data['prenom']);

            $this->manager->persist($administrateur);

            $user = new User();
            $user->setEmail($data['email']);
            $password = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $user->setAdministrateur($administrateur);

            $this->manager->persist($user);
        }
        for ($i = 0; $i < 2; $i++) {
            $administrateur = new Administrateur();
            $administrateur->setNom($this->faker->lastName());
            $administrateur->setPrenom($this->faker->firstName());

            $this->manager->persist($administrateur);

            $user = new User();
            $user->setEmail($this->faker->safeEmail());
            $password = $this->hasher->hashPassword($user, '123');
            $user->setPassword($password);
            $user->setRoles($data['roles']);

            $user->setAdministrateur($administrateur);

            $this->manager->persist($user);
        }
        $this->manager->flush();
    }
}
