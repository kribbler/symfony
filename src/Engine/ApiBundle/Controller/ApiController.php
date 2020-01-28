<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Controller;

use App\Engine\ApiBundle\Entity\Book;
use App\Engine\ApiBundle\Form\Type\BookType;
use App\Engine\ApiBundle\Service\ApiProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    /** @var ApiProcessor */
    private $apiProcessor;

    public function __construct(ApiProcessor $apiProcessor)
    {
        $this->apiProcessor = $apiProcessor;
    }

    public function indexAction(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        $response = new JsonResponse();

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setData('Invalid ISBN');
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);

            return $response;
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $response->setData([
                'isbn' => $book->getIsbn(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'category' => $book->getCategory(),
                'price' => $book->getPrice(),
            ]);
            $response->setStatusCode(Response::HTTP_CREATED);

            return $response;
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function authorAction(Request $request): JsonResponse
    {
        $response = new JsonResponse();

        $results = $this->apiProcessor->getBooksByAuthor(
            $request->get('name')
        );
        $response->setData($results);
        
        return $response;
    }

    public function listCategoriesAction(Request $request): JsonResponse
    {
        $response = new JsonResponse();
        
        $results = $this->apiProcessor->getCategories();
        $response->setData($results);

        return $response;
    }

    public function categoryAction(Request $request): JsonResponse
    {
        $response = new JsonResponse();

        $results = $this->apiProcessor->getBooksByCategory(
            $request->get('name')
        );
        $response->setData($results);

        return $response;
    }

    public function authorCategoryAction(Request $request): JsonResponse
    {
        $response = new JsonResponse();
        
        $results = $this->apiProcessor->getBooksByAuthorAndCategory(
            $request->get('author_name'),
            $request->get('category_name')
        );
        $response->setData($results);

        return $response;
    }
}
