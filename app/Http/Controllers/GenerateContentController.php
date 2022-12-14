<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Profession;
use App\Models\Sphere;
use App\Models\Technology;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\CatQuestCount;
use Illuminate\Http\Request;

class GenerateContentController extends Controller
{
    public function createContent(string $admin)
    {
        $userFields = [
            'name' => 'admin',
            'surname' => 'admin',
            'login' => 'admin',
            'password' => 'admin',];
        $userFields['key'] = time();
        $user = User::create($userFields);


        $web = Sphere::create(['name' => 'Web', 'creator_id' => $user->id]);
        $mobile = Sphere::create(['name' => 'Mobile', 'creator_id' => $user->id]);

        $webBack = Direction::create(['name' => 'Backend', 'creator_id' => $user->id, 'sphere_id' => $web->id]);
        $webFront = Direction::create(['name' => 'Frontend', 'creator_id' => $user->id, 'sphere_id' => $web->id]);
        $mobFront = Direction::create(['name' => 'Frontend', 'creator_id' => $user->id, 'sphere_id' => $mobile->id]);

        $cSharp = Technology::create(['name' => 'C#', 'creator_id' => $user->id, 'direction_id' => $webBack->id]);
        $php = Technology::create(['name' => 'PHP', 'creator_id' => $user->id, 'direction_id' => $webBack->id]);
        $javascript = Technology::create(['name' => 'Javascript', 'creator_id' => $user->id, 'direction_id' => $webFront->id]);
        $kotlin = Technology::create(['name' => 'Kotlin', 'creator_id' => $user->id, 'direction_id' => $mobFront->id]);

        $juniorPHP = Profession::create(['name' => 'Junior PHP-разработчик', 'creator_id' => $user->id, 'technology_id' => $php->id]);
        $juniorCSharp = Profession::create(['name' => 'Junior C#-разработчик', 'creator_id' => $user->id, 'technology_id' => $cSharp->id]);
        $juniorJS = Profession::create(['name' => 'Junior Javascript-разработчик', 'creator_id' => $user->id, 'technology_id' => $javascript->id]);
        $juniorKotlin = Profession::create(['name' => 'Junior kotlin-разработчик', 'creator_id' => $user->id, 'technology_id' => $kotlin->id]);

        $catSQL = Category::create(['name' => 'SQL', 'creator_id' => $user->id]);
        $catCSharp = Category::create(['name' => 'C#', 'creator_id' => $user->id]);
        $catJavascript = Category::create(['name' => 'Javascript', 'creator_id' => $user->id]);
        $catHtml = Category::create(['name' => 'Html', 'creator_id' => $user->id]);
        $catCss = Category::create(['name' => 'CSS', 'creator_id' => $user->id]);
        $catPhp = Category::create(['name' => 'PHP', 'creator_id' => $user->id]);
        $catKotlin = Category::create(['name' => 'Kotlin', 'creator_id' => $user->id]);



        $countKotlin=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorKotlin->id,'category_id'=>$catKotlin->id]);
        $countJavascript=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorJS->id,'category_id'=>$catJavascript->id]);
        $countSQL=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorCSharp->id,'category_id'=>$catSQL->id]);
        $countHtml=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorJS->id,'category_id'=>$catHtml->id]);
        $countCSS=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorJS->id,'category_id'=>$catCss->id]);
        $countPHP=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorPHP->id,'category_id'=>$catPhp->id]);
        $countSQLPHP=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorPHP->id,'category_id'=>$catSQL->id]);
        $countCSharp=CatQuestCount::create(['count'=>10,'profession_id'=>$juniorCSharp->id,'category_id'=>$catCSharp->id]);

        $question1=Question::create(['category_id'=>$catPhp->id,'question'=>'что такое массив в php','answer'=>'массив - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catPhp->id,'question'=>'что такое интерфейс в php','answer'=>'интерфейс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catPhp->id,'question'=>'что такое класс в php ','answer'=>'класс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catPhp->id,'question'=>'что такое трейт в php','answer'=>'трейт - ответ','creator_id'=>$user->id]);

        $question1=Question::create(['category_id'=>$catCSharp->id,'question'=>'что такое массив в c#','answer'=>'массив - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catCSharp->id,'question'=>'что такое интерфейс в c#','answer'=>'интерфейс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catCSharp->id,'question'=>'что такое класс в c#','answer'=>'класс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catCSharp->id,'question'=>'что такое трейт в c#','answer'=>'трейт - ответ','creator_id'=>$user->id]);

        $question1=Question::create(['category_id'=>$catKotlin->id,'question'=>'что такое массив в kotlin','answer'=>'массив - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catKotlin->id,'question'=>'что такое интерфейс в kotlin','answer'=>'интерфейс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catKotlin->id,'question'=>'что такое класс в kotlin','answer'=>'класс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catKotlin->id,'question'=>'что такое трейт в kotlin','answer'=>'трейт - ответ','creator_id'=>$user->id]);

        $question1=Question::create(['category_id'=>$catJavascript->id,'question'=>'что такое массив в js','answer'=>'массив - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catJavascript->id,'question'=>'что такое интерфейс в js','answer'=>'интерфейс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catJavascript->id,'question'=>'что такое класс в js','answer'=>'класс - ответ','creator_id'=>$user->id]);
        $question1=Question::create(['category_id'=>$catJavascript->id,'question'=>'что такое трейт в js','answer'=>'трейт - ответ','creator_id'=>$user->id]);

        dd('ok');
    }

}

