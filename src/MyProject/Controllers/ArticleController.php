<?php
    namespace MyProject\Controllers;
    use MyProject\View\View;
    use MyProject\Models\Articles\Article;
    use MyProject\Models\Users\User;
    use MyProject\Models\Comments\Comments;

    class ArticleController{
        private $view;
        public function __construct(){
            $this->view = new View(__DIR__.'/../../../templates');
        }
        public function view(int $idArticle){
            $article = Article::getById($idArticle);
            if ($article === null){
                $this->view->renderHtml('errors/404.php', [], 404);
                return;
            }
            $comments = Comments::getByArticleId($idArticle);
            $this->view->renderHtml('articles/view.php', ['articles' => $article, 'comments'=>$comments]);
        }

        public function edit(int $articleId): void
        {
            $article = Article::getById($articleId);
            if ($article === null){
                $this->view->renderHtml('errors/404.php', [], 404);
                return;
            }
            $article->setName('New value');
            $article->setText('New text');
            $article->save();            
        }
        public function add(): void
        {
            $author = User::getById(1);
            $article = new Article();
            $article->setName('Новая статья');
            $article->setText('Новый текст');
            $article->setAuthorId($author);
            $article->save();  
            // var_dump($article);          
        }
        public function delete(int $articleId){
            $article =Article::getById($articleId);
            if ($article === null){
                $this->view->renderHtml('errors/404.php', [], 404);
                return;
            } 
            $article->delete();
        }
     
    }
?>