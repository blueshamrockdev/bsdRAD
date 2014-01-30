<?PHP

namespace BlueShamrock\Symfony\BsdRADBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * Lazy function that gets a service or parameter by id.
     *
     * @param string $id The service/parameter id
     *
     * @return object The service
     */
    public function get($id)
    {
        if ($this->container->has($id)) {
            return $this->container->get($id);
        } elseif ($this->container->hasParameter($id)) {
            return $this->container->getParameter($id);
        }

        return false;
    }

    /**
     * Borrowed from KnpRAD Bundle
     * @see https://github.com/KnpLabs/KnpRadBundle
     *
     * @param       $entity
     * @param array $criterias
     * @return null
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function findOr404($entity, $criterias = array())
    {
        $result     = null;
        $findMethod = is_scalar($criterias) ? 'find' : 'findOneBy';

        if (is_object($entity) && $entity instanceof EntityRepository) {
            $result = $entity->$findMethod($criterias);
        } elseif (is_object($entity) && $this->getEntityManager()->contains($entity)) {
            $result = $this->getEntityManager()->refresh($entity);
        } elseif (is_string($entity)) {
            $repository = $this->getRepository($entity);
            $result     = $repository->$findMethod($criterias);
        }

        if (null !== $result) {
            return $result;
        }

        throw $this->createNotFoundException('Resource not found');
    }

    /**
     * Get Repository
     *
     * @param string      $repo    Bundle:Entity
     * @param string|null $manager entity manager name
     *
     * @return EntityRepository
     */
    public function getRepository($repo, $manager = null)
    {
        return $this->getDoctrine()->getManager($manager)->getRepository($repo);
    }
}
