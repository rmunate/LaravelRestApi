<?php

namespace Lomkit\Rest\Documentation\Schemas;

use Illuminate\Support\Str;
use Lomkit\Rest\Http\Controllers\Controller;

class Operation extends Schema
{
    /**
     * A list of tags for API documentation control.
     * Tags can be used for logical grouping of operations by resources or any other qualifier.
     * @var array
     */
    protected array $tags = [];

    /**
     * A short summary of what the operation does.
     * @var string
     */
    protected string $summary;

    /**
     * A verbose explanation of the operation behavior.
     * CommonMark syntax MAY be used for rich text representation.
     * @var string
     */
    protected string $description;

    /**
     * The request body applicable for this operation.
     * @var RequestBody
     */
    protected RequestBody $requestBody;

    /**
     * The list of possible responses as they are returned from executing this operation.
     * @var Responses
     */
    protected Responses $responses;

    public function withTags(array $tags): Operation
    {
        $this->tags = array_merge($this->tags, $tags);
        return $this;
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function withSummary(string $summary): Operation
    {
        $this->summary = $summary;
        return $this;
    }

    public function summary(): string
    {
        return $this->summary;
    }

    public function withDescription(string $description): Operation
    {
        $this->description = $description;
        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function withResponses(Responses $responses): Operation
    {
        $this->responses = $responses;
        return $this;
    }

    public function responses(): Responses
    {
        return $this->responses;
    }

    public function withRequestBody(RequestBody $requestBody): Operation
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    public function requestBody(): RequestBody
    {
        return $this->requestBody;
    }

    public function jsonSerialize(): mixed
    {
        return array_merge(
            isset($this->tags) ? ['tags' => $this->tags()] : [],
            isset($this->summary) ? ['summary' => $this->summary()] : [],
            isset($this->responses) ? ['responses' => $this->responses()->jsonSerialize()] : [],
            isset($this->description) ? ['description' => $this->description()] : [],
            isset($this->requestBody) ? ['requestBody' => $this->requestBody()->jsonSerialize()] : []
        );
    }

    public function generate(): Schema
    {
        return $this;
    }

    public function generateDetail(Controller $controller): Operation
    {
        return $controller->generateDocumentationDetailOperation(
            $this
                ->withSummary('Get the resource detail')
                ->withDescription('Get every detail about the resource according to the current user connected')
                ->withResponses(
                    (new Responses)->generateDetail($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->generate()
        );
    }

    public function generateSearch(Controller $controller): Operation
    {
        return $controller->generateDocumentationSearchOperation(
            $this
                ->withSummary('Perform a search request')
                ->withDescription('Crunch the Api\'s data with multiple attributes')
                ->withResponses(
                    (new Responses)->generateSearch($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateSearch($controller)
                )
                ->generate()
        );
    }

    public function generateMutate(Controller $controller): Operation
    {
        return $controller->generateDocumentationMutateOperation(
            $this
                ->withSummary('Perform a mutate request')
                ->withDescription('Create / Modify the database data with multiple options')
                ->withResponses(
                    (new Responses)->generateMutate($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateMutate($controller)
                )
                ->generate()
        );
    }

    public function generateActions(Controller $controller): Operation
    {
        return $controller->generateDocumentationActionsOperation(
            $this
                ->withSummary('Perform an action request')
                ->withDescription('Launch actions')
                ->withResponses(
                    (new Responses)->generateActions($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateActions($controller)
                )
                ->generate()
        );
    }

    public function generateDestroy(Controller $controller): Operation
    {
        return $controller->generateDocumentationDestroyOperation(
            $this
                ->withSummary('Perform a destroy request')
                ->withDescription('Delete database records using primary key')
                ->withResponses(
                    (new Responses)->generateDestroy($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateDestroy($controller)
                )
                ->generate()
        );
    }

    public function generateRestore(Controller $controller): Operation
    {
        return $controller->generateDocumentationRestoreOperation(
            $this
                ->withSummary('Perform a restore request')
                ->withDescription('Restore a soft deleted record')
                ->withResponses(
                    (new Responses)->generateRestore($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateRestore($controller)
                )
                ->generate()
        );
    }

    public function generateForceDelete(Controller $controller): Operation
    {
        return $controller->generateDocumentationForceDeleteOperation(
            $this
                ->withSummary('Perform a force delete request')
                ->withDescription('Force delete a record')
                ->withResponses(
                    (new Responses)->generateForceDelete($controller)
                )
                ->withTags([
                    Str::plural((new \ReflectionClass($controller::newResource()::newModel()))->getShortName())
                ])
                ->withRequestBody(
                    (new RequestBody)->generateForceDelete($controller)
                )
                ->generate()
        );
    }
}