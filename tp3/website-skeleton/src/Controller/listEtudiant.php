#[route('/list',name:'liste)]
public function listEtudiant(){
$etudiant = array("ali","med");
$modules = array(
array("id"=>1,"enseignant"=>"ali","nbreheures"=>42,"date"=>"12-5-2021"),
array("id"=>2,"enseignant"=>"med","nbreheures"=>31,"date"=>"12-5-2022"),
array("id"=>3,"enseignant"=>"islem","nbreheures"=>22,"date"=>"12-6-2023")
);
return $this->render('list.html.twig',[
'etudiant'=>$etudiant,
'listModules'=>$modules
]);
}

#[route('/affichectation',name:'affectation')]
public function affecter(){
return $this->render('affecter.html.twig');

}

#[route('/index',name:'index')]
public function index(){
return $this->render('index.html.twig');
}