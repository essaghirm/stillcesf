<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MakeJson
{
    public function json($input, $ignoredAttr = null)
    {
        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);

        if(is_array($ignoredAttr)){
            $ignoredAttr = array_merge($ignoredAttr, array('__initializer__', '__cloner__', '__isInitialized__'));
        }else{
            $ignoredAttr = array('__initializer__', '__cloner__', '__isInitialized__');
        }

        $normalizer->setIgnoredAttributes($ignoredAttr);

        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            // return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($input, 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}