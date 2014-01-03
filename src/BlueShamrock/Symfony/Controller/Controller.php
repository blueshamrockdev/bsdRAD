<?PHP

namespace BlueShamrock\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
 
    /**
     * Borrowed from KnpRAD Bundle
     * @see https://github.com/KnpLabs/KnpRadBundle
     *
     * 
     *
     */
    protected function findOr404($entity, $criterias = array())
    {
        $result = null;
        $findMethod = is_scalar($criterias) ? 'find' : 'findOneBy';

        if (is_object($entity) && $entity instanceof EntityRepository) {
            $result = $entity->$findMethod($criterias);
        } elseif (is_object($entity) && $this->getEntityManager()->contains($entity)) {
            $result = $this->getEntityManager()->refresh($entity);
        } elseif (is_string($entity)) {
            $repository = $this->getRepository($entity);
            $result = $repository->$findMethod($criterias);
        }

        if (null !== $result) {
            return $result;
        }

        throw $this->createNotFoundException('Resource not found');
    }

    /**
     * Lazy function that gets a service or parameter by id.
     *
     * @param string $id The service/parameter id
     *
     * @return object The service
     */
    public function get($id)
    {
        if($this->container->has($id)) {
            return $this->container->get($id);
        } elseif($this->container->hasParameter($id)) {
            return $this->container->getParameter($id);
        } 

        return false;
    }
}
